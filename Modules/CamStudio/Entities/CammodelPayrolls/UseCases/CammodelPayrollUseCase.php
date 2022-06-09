<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\UseCases;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\CamStudio\Entities\CammodelFines\Repositories\Interfaces\CammodelFineRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\CammodelPayrollNotFoundException;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\CreateCammodelPayrollErrorException;
use Modules\CamStudio\Entities\CammodelPayrolls\Repositories\CammodelPayrollRepository;
use Modules\CamStudio\Entities\CammodelPayrolls\Repositories\Interfaces\CammodelPayrollRepositoryInterface;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces\CammodelPayrollUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces\CammodelStreamingIncomeUseCaseInterface;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;

class CammodelPayrollUseCase implements CammodelPayrollUseCaseInterface
{
    private $toolsInterface, $cammodelPayrollInterface, $cammodelStreamingIncomeInterface;
    private $cammodelStreamingIncomeServiceInterface, $cammodelFineInterface, $CamsodaCopRate, $employeeInterface;
    private $cammodelStreamAccountInterface, $cammodelInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelPayrollRepositoryInterface $cammodelPayrollRepositoryInterface,
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface,
        CammodelStreamingIncomeRepositoryInterface $cammodelStreamingIncomeRepositoryInterface,
        CammodelStreamingIncomeUseCaseInterface $cammodelStreamingIncomeUseCaseInterface,
        CammodelFineRepositoryInterface $cammodelFineRepositoryInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface
    ) {
        $this->toolsInterface                          = $toolRepositoryInterface;
        $this->cammodelPayrollInterface                = $cammodelPayrollRepositoryInterface;
        $this->cammodelStreamAccountInterface          = $cammodelStreamAccountRepositoryInterface;
        $this->cammodelStreamingIncomeInterface        = $cammodelStreamingIncomeRepositoryInterface;
        $this->cammodelStreamingIncomeServiceInterface = $cammodelStreamingIncomeUseCaseInterface;
        $this->cammodelFineInterface                   = $cammodelFineRepositoryInterface;
        $this->cammodelInterface                       = $cammodelRepositoryInterface;
        $this->employeeInterface                       = $employeeRepositoryInterface;
        $this->module                                  = 'Nomina Modelos';
        $this->CamsodaCopRate                          = 60;
    }

    public function listCammodelPayrolls(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->cammodelPayrollInterface->searchCammodelPayroll($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->cammodelPayrollInterface->countCammodelPayroll($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->cammodelPayrollInterface->searchCammodelPayroll($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->cammodelPayrollInterface->countCammodelPayroll($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->cammodelPayrollInterface->countCammodelPayroll(null);
            $list     = $this->cammodelPayrollInterface->listCammodelPayrolls($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'cammodel_payrolls' => $list,
                'optionsRoutes'     => config('generals.optionRoutes'),
                'module'            => $this->module,
                'headers'           => ['Fecha', 'Modelo', 'Bonificación', 'Total USD Modelo', 'Total Pesos', 'TRM', 'Usuario Aprueba', 'Opciones'],
                'skip'              => $searchData['skip'],
                'paginate'          => $getPaginate['paginate'],
                'position'          => $getPaginate['position'],
                'page'              => $getPaginate['page'],
                'limit'             => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCammodelPayroll()
    {
        return [
            'optionsRoutes'                 => config('generals.optionRoutes'),
            'module'                        => $this->module,
            'uncutCammodelStreamingIncomes' => $this->getCammodelIncomes(null, $this->toolsInterface->getPayrollPeriodDates())
        ];
    }

    public function storeCammodelPayroll(array $requestData)
    {
        $periodDates = $this->toolsInterface->getPayrollPeriodDates();
        $accountsIncomes = $this->getCammodelIncomes($accountIds = null, $periodDates);
        $incomes     = $this->liquidateCammodelIncomes($accountsIncomes, $requestData['trm']);
        $incomes->each(function ($income) use ($periodDates) {
            $income['from'] = $periodDates[0];
            $income['to']   = $periodDates[1];
            $cammodelPayroll = $this->cammodelPayrollInterface->createCammodelPayroll($income);
            $this->deletePeriodIncomes($income, $cammodelPayroll);
            $this->deletePeriodFines($income['cammodel_id'], $cammodelPayroll);
        });
    }

    public function getCammodelsLiquidations($dates = null)
    {
        $periodDates = $dates == null ?
            $this->toolsInterface->getCammodelStatsPeriodDates() :
            $dates;

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|operative_leader_aux|partner|subsidiary_supervisor')) {
            $cammodels = $this->cammodelInterface->getSubsidiaryCammodels(auth()->guard('employee')->user()->subsidiary_id, 1);
            $cammodelIds = [];
            foreach ($cammodels as $key => $cammodel) {
                foreach ($cammodel->cammodelStreamAccountsWithoutSkype as $streamAccount) {
                    array_push($cammodelIds, $streamAccount->id);
                }
            }

            $liquidations = $this->liquidateCammodelIncomes($this->getCammodelIncomes($cammodelIds, $periodDates), 3500);
        } else {
            $liquidations = $this->liquidateCammodelIncomes($this->getCammodelIncomes($cammodelIds = null, $periodDates), 3500);
        }

        return $liquidations;
    }

    public function getPeriodCammodelsLiquidations($dates = null, array $filtersData)
    {
        $periodDates = $dates == null ?
            $this->toolsInterface->getCammodelStatsPeriodDates() :
            $dates;

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|operative_leader_aux|partner|subsidiary_supervisor')) {
            if ($filtersData['cammodel_id'] != null) {
                $cammodelIds = $this->cammodelStreamAccountInterface
                    ->findStreamAccountByCammodel($filtersData['cammodel_id'])
                    ->pluck('id')->all();
            } else {
                $cammodels = $this->cammodelInterface->getSubsidiaryCammodels(auth()->guard('employee')->user()->subsidiary_id, 1);
                $cammodelIds = [];
                foreach ($cammodels as $key => $cammodel) {
                    foreach ($cammodel->cammodelStreamAccountsWithoutSkype as $streamAccount) {
                        array_push($cammodelIds, $streamAccount->id);
                    }
                }
            }

            $liquidations = $this->liquidateCammodelIncomes($this->getPeriodCammodelIncomes($periodDates, $cammodelIds, auth()->guard('employee')->user()->subsidiary_id), 3500);
        } else {
            if ($filtersData['subsidiary_id'] != null) {
                if ($filtersData['cammodel_id'] != null) {
                    $cammodelIds = $this->cammodelStreamAccountInterface
                        ->findStreamAccountByCammodel($filtersData['cammodel_id'])
                        ->pluck('id')->all();
                } else {
                    // $cammodels = $this->cammodelInterface->getSubsidiaryCammodels($filtersData['subsidiary_id'], 1);
                    // $cammodelIds = [];
                    $cammodelIds = null;
                    // foreach ($cammodels as $key => $cammodel) {
                    //     foreach ($cammodel->cammodelStreamAccountsWithoutSkype as $streamAccount) {
                    //         array_push($cammodelIds, $streamAccount->id);
                    //     }
                    // }
                }

                $liquidations = $this->liquidateCammodelIncomes($this->getPeriodCammodelIncomes($periodDates, $cammodelIds, $filtersData['subsidiary_id']), 3500);
            } else {
                if ($filtersData['cammodel_id'] != null) {
                    $cammodelIds = $this->cammodelStreamAccountInterface
                        ->findStreamAccountByCammodel($filtersData['cammodel_id'])
                        ->pluck('id')->all();
                    $liquidations = $this->liquidateCammodelIncomes($this->getPeriodCammodelIncomes($periodDates, $cammodelIds), 3500);
                } else {
                    $liquidations = $this->liquidateCammodelIncomes($this->getPeriodCammodelIncomes($periodDates), 3500);
                }
            }
        }

        return $liquidations;
    }

    public function getCammodelLiquidations(int $cammodelId)
    {
        $cammodelAccounts = $this->cammodelStreamAccountInterface->findStreamAccountByCammodel($cammodelId)->pluck('id')->all();

        $streamingIncomes = $this->liquidateCammodelIncomes($this->getCammodelIncomes($cammodelAccounts, $this->toolsInterface->getCammodelStatsPeriodDates()), 3500);

        return $streamingIncomes;
    }

    public function getCammodelPastLiquidations(int $cammodelId)
    {
        $cammodelAccounts = $this->cammodelStreamAccountInterface->findStreamAccountByCammodel($cammodelId)->pluck('id')->all();

        $fortnightsIncomes = [];

        for ($i = 3; $i >= 0; $i--) {
            $fortnightDates = $this->toolsInterface->getPastFortnightDates($i);
            $streamingIncomes = $this->liquidateCammodelIncomes($this->getAllPeriodCammodelIncomes($cammodelAccounts, $fortnightDates), 3500);
            array_push($fortnightsIncomes, $streamingIncomes);
        }

        return $fortnightsIncomes;
    }

    public function deletePeriodIncomes($income, $cammodelPayroll)
    {
        $accounts = [];
        foreach ($income['incomes'] as $value) {
            array_push($accounts, $value->cammodel_stream_account_id);
        }

        $periodApprovedIncomes = $this->cammodelStreamingIncomeInterface->getAprobedCammodelStreamingIncomesPeriodForDelete($accounts, $this->toolsInterface->getPayrollPeriodDates());
        $periodApprovedIncomes->each(function ($periodApprovedIncome) use ($cammodelPayroll) {
            $periodApprovedIncome->cammodel_payroll_id = $cammodelPayroll->id;
            $periodApprovedIncome->save();
        });
    }

    public function deletePeriodFines($cammodelId, $cammodelPayroll)
    {
        $cammodelFines = $this->cammodelFineInterface->findUnchargedCammodelFinesByCammodel($cammodelId, $this->toolsInterface->getPayrollPeriodDates());
        $cammodelFines->each(function ($cammodelFine) use ($cammodelPayroll) {
            $cammodelFine->cammodel_payroll_id = $cammodelPayroll->id;
            $cammodelFine->save();
        });
    }

    public function showCammodelPayroll(int $id)
    {
        return [
            'cammodel_payroll' => $this->getCammodelPayroll($id),
            'optionsRoutes'    => config('generals.optionRoutes'),
            'module'           => $this->module
        ];
    }

    public function updateCammodelPayroll(array $requestData, int $id)
    {
        $cammodelPayroll              = $this->getCammodelPayroll($id);
        $user                         = $this->toolsInterface->setSignedUser();
        $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
        $update                       = new CammodelPayrollRepository($cammodelPayroll);
        $update->updateCammodelPayroll($requestData);
    }

    public function reCalculateCammodelPayroll($id)
    {
        $cammodelPayroll = $this->getCammodelPayroll($id);
        $cammodelPayroll = $this->cammodelStreamingIncomeServiceInterface->reseteCammodelStreamingIncomeValues($cammodelPayroll);
        $this->cammodelStreamingIncomeServiceInterface->updateCammodelStreamingIncomes($cammodelPayroll, $cammodelPayroll->cammodelStreamingIncomes);

        return $cammodelPayroll->id;
    }

    public function getCammodelPayroll(int $id)
    {
        try {
            return $this->cammodelPayrollInterface->findCammodelPayrollById($id);
        } catch (CammodelPayrollNotFoundException $e) {
            throw new CammodelPayrollNotFoundException($e->getMessage());
        }
    }

    public function getCammodelIncomes($accountIds = null, $dates): Collection
    {
        if ($accountIds == null) {
            $periodIncomes = $this->cammodelStreamingIncomeInterface->getAprobedCammodelStreamingIncomesPeriod($dates);
        } else {
            $periodIncomes = $this->cammodelStreamingIncomeInterface->getAprobedSubsidiaryStreamingIncomesPeriod($dates, $accountIds);
        }

        $accountsIncomes = new Collection();
        $periodIncomes->groupBy('cammodel_stream_account_id')->map(function ($values) use ($accountsIncomes) {
            $accountsIncomes->push($values->sortByDesc('accumulated_dollars')->first());
        });

        return $accountsIncomes;
    }

    public function getPeriodCammodelIncomes($dates, $accountIds = null, $subsidiaryId = null): Collection
    {
        $periodIncomes = new Collection();
        if ($accountIds === null) {
            $periodIncomes = $this->cammodelStreamingIncomeInterface->getPeriodAprobedCammodelStreamingIncomes($dates, $subsidiaryId);
        } else {
            $periodIncomes = $this->cammodelStreamingIncomeInterface->getPeriodAprobedSubsidiaryStreamingIncomes($dates, $accountIds, $subsidiaryId);
        }

        $accountsIncomes = new Collection();
        $periodIncomes->groupBy('cammodel_stream_account_id')->map(function ($values) use ($accountsIncomes) {
            $accountsIncomes->push($values->sortByDesc('accumulated_dollars')->first());
        });

        return $accountsIncomes;
    }

    public function getAllPeriodCammodelIncomes(array $accountIds, array $dates): Collection
    {
        $periodIncomes = $this->cammodelStreamingIncomeInterface->getAllPeriodCammodelIncomes($dates, $accountIds);

        $accountsIncomes = new Collection();
        $periodIncomes->groupBy('cammodel_stream_account_id')->map(function ($values) use ($accountsIncomes) {
            $accountsIncomes->push($values->sortByDesc('accumulated_dollars')->first());
        });

        return $accountsIncomes;
    }

    public function liquidateCammodelIncomes($accountsIncomes, $trm)
    {
        $cammodelsTotalIncomes =  $this->packageCammodelIncomes($accountsIncomes, $trm);
        $cammodelsTotalIncomes->map(function ($cammodelTotalIncomes, $key) use ($cammodelsTotalIncomes) {
            $cammodelTotalIncomes['total_cop_cammodel'] = round($cammodelTotalIncomes['total_usd_cammodel'] * $cammodelTotalIncomes['trm'], 2);
            $cammodelTotalIncomes                       = $this->modifiyCamsodaIncomes($cammodelTotalIncomes);
            $cammodelTotalIncomes                       = $this->setIncomesAdjustments($cammodelTotalIncomes);
            $totalFines                                 = $this->getCammodelFines($cammodelTotalIncomes['cammodel']->id);
            $cammodelTotalIncomes['total_cop_cammodel'] -= $totalFines;
            $cammodelTotalIncomes['incomes']            = $cammodelTotalIncomes['incomes'];
            $cammodelsTotalIncomes[$key]                = $cammodelTotalIncomes;
        });

        return $cammodelsTotalIncomes;
    }

    public function packageCammodelIncomes($accountsIncomes, $trm)
    {
        $cammodelsIncomes = new Collection();
        $accountsIncomes->map(function ($accountIncomes) use ($cammodelsIncomes) {
            if ($accountIncomes->cammodelStreamAccount) {
                $cammodelsIncomes->push([
                    'cammodel_id' => $accountIncomes->cammodelStreamAccount->cammodel_id,
                    'cammodel'    => $accountIncomes->cammodelStreamAccount->cammodelWithEmployee,
                    'incomes'     => $accountIncomes,
                    'value'       => $accountIncomes->accumulated_dollars,
                ]);
            }
        });

        $cammodelsTotalIncomes = new Collection();
        $cammodelsIncomes->groupBy('cammodel_id')->map(function ($cammodelIncomes, $cammodel_id) use ($cammodelsTotalIncomes, $trm) {
            $cammodelIncomesInArray = [];
            foreach ($cammodelIncomes as $key => $value) {
                array_push($cammodelIncomesInArray, $cammodelIncomes[$key]['incomes']);
            }

            $cammodelsTotalIncomes->push([
                'cammodel_id'        => $cammodel_id,
                'cammodel'           => $cammodelIncomes[0]['cammodel'],
                'incomes'            => $cammodelIncomesInArray,
                'usd_cammodel'       => $cammodelIncomes->sum('value'),
                'total_usd_cammodel' => round(($cammodelIncomes->sum('value') / 2), 3),
                'usd_studio'         => round(($cammodelIncomes->sum('value') / 2), 3),
                'trm'                => $trm,
                'total_cop_cammodel' => 0
            ]);
        });

        return $cammodelsTotalIncomes;
    }

    public function setIncomesAdjustments($cammodelTotalIncomes)
    {
        if ($this->finishGoal($cammodelTotalIncomes)) {
            $cammodelTotalIncomes['bonus']              =  round($cammodelTotalIncomes['total_cop_cammodel'] * $cammodelTotalIncomes['cammodel']->shift->goal->bonus, 3);
            $cammodelTotalIncomes['total_cop_cammodel'] += $cammodelTotalIncomes['bonus'];
        } elseif ($this->payrollAdjusment($cammodelTotalIncomes)) {
            $cammodelTotalIncomes['bonus']              =  $cammodelTotalIncomes['cammodel']->shift->goal->min_goal_adjustment - $cammodelTotalIncomes['total_cop_cammodel'];
            $cammodelTotalIncomes['total_cop_cammodel'] += $cammodelTotalIncomes['bonus'];
        } else {
            $cammodelTotalIncomes['bonus']              = 0;
            $cammodelTotalIncomes['total_cop_cammodel'] = $cammodelTotalIncomes['total_cop_cammodel'];
        }

        return $cammodelTotalIncomes;
    }

    public function getCammodelFines($cammodelId): int
    {
        $cammodelFines = $this->cammodelFineInterface->findUnchargedCammodelFinesByCammodel($cammodelId, $this->toolsInterface->getPayrollPeriodDates());
        $totalFines    = 0;
        foreach ($cammodelFines as $value) {
            $totalFines += $value->foul->charge;
        }
        return  $totalFines;
    }

    private function modifiyCamsodaIncomes($cammodelTotalIncomes)
    {
        $camsodaCammodelIncomesCollect = new Collection();

        foreach ($cammodelTotalIncomes['incomes'] as $income) {
            if ($income->cammodelStreamAccount->streaming->id == 4) {
                $camsodaCammodelIncomesCollect->push($income);
            }
        }

        $camsodaTotalPesos                          =  (round($camsodaCammodelIncomesCollect->sum('accumulated_dollars') / 2, 3)) * $cammodelTotalIncomes['trm'];
        $cammodelTotalIncomes['total_cop_cammodel'] -= $camsodaTotalPesos;
        $camsodaTotalTokensInCop                    =  ($camsodaCammodelIncomesCollect->sum('accumulated_tokens')) * $this->CamsodaCopRate;
        $cammodelTotalIncomes['total_cop_cammodel'] += $camsodaTotalTokensInCop;

        return $cammodelTotalIncomes;
    }

    public function destroyCammodelPayroll(int $id)
    {
        $update = new CammodelPayrollRepository($this->getCammodelPayroll($id));
        $update->deleteCammodelPayroll();
    }

    public function exportCammodelPayroll($id)
    {
        $cammodel_payroll = $this->getCammodelPayroll($id);
        return 'corte' . " " . $cammodel_payroll->created_at->format('Y-m-d') . '.xlsx';
    }

    public function exportCammodelPayrollBankTransfers($id)
    {
        $cammodel_payroll = $this->getCammodelPayroll($id);
        return 'transferencias' . " " . $cammodel_payroll->created_at->format('Y-m-d') . '.xlsx';
    }

    private function finishGoal($cammodelTotalIncomes): bool
    {
        return $cammodelTotalIncomes['total_usd_cammodel'] >= $cammodelTotalIncomes['cammodel']->shift->goal->usd_goal;
    }

    private function payrollAdjusment($cammodelTotalIncomes): bool
    {
        return $cammodelTotalIncomes['total_cop_cammodel'] <= $cammodelTotalIncomes['cammodel']->shift->goal->min_goal_adjustment  && $cammodelTotalIncomes['total_usd_cammodel'] >= $cammodelTotalIncomes['cammodel']->shift->goal->min_usd_goal;
    }
}
