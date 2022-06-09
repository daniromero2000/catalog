<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases;

use Carbon\Carbon;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\ChaturbateMasterAccount;
use Modules\CamStudio\Entities\CammodelFines\UseCases\Interfaces\CammodelFineUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\CreateCammodelStreamingIncomeErrorException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\CammodelStreamingIncomeNotFoundException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\CammodelStreamingIncomeRepository;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\UseCases\Interfaces\CammodelStreamingIncomeUseCaseInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\Interfaces\CammodelWorkReportRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\UseCases\Interfaces\CammodelWorkReportUseCaseInterface;
use Modules\CamStudio\Entities\Fouls\Repositories\Interfaces\FoulRepositoryInterface;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelStreamingIncomeUseCase implements CammodelStreamingIncomeUseCaseInterface
{
    private $cammodelStreamingIncomeInterface, $toolsInterface, $streamingServiceInterface, $module ;
    private $cammodelWorkReportInterface, $cammodelStreamAccountInterface, $cammodelWorkReportServiceInterface;
    private $foulInterface, $cammodelFineServiceInterface, $cammodelInterface, $employeeInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelFineUseCaseInterface $cammodelFineUseCaseInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface,
        CammodelStreamingIncomeRepositoryInterface $cammodelStreamingIncomeRepositoryInterface,
        CammodelWorkReportRepositoryInterface $cammodelWorkReportRepositoryInterface,
        CammodelWorkReportUseCaseInterface $cammodelWorkReportUseCaseInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        FoulRepositoryInterface $foulRepositoryInterface,
        StreamingUseCaseInterface $streamingUseCaseInterface
    ) {
        $this->toolsInterface                     = $toolRepositoryInterface;
        $this->cammodelInterface                  = $cammodelRepositoryInterface;
        $this->cammodelFineServiceInterface       = $cammodelFineUseCaseInterface;
        $this->cammodelInterface                  = $cammodelRepositoryInterface;
        $this->cammodelStreamAccountInterface     = $cammodelStreamAccountRepositoryInterface;
        $this->cammodelStreamingIncomeInterface   = $cammodelStreamingIncomeRepositoryInterface;
        $this->cammodelWorkReportInterface        = $cammodelWorkReportRepositoryInterface;
        $this->cammodelWorkReportServiceInterface = $cammodelWorkReportUseCaseInterface;
        $this->employeeInterface                  = $employeeRepositoryInterface;
        $this->foulInterface                      = $foulRepositoryInterface;
        $this->streamingServiceInterface          = $streamingUseCaseInterface;
        $this->module                             = 'Ingresos de Plataformas';
    }

    public function listCammodelStreamingIncomes(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];
        $searchData['where'] = array_key_exists('status', $data['search']) ?
            ($data['search']['status'] == "1" ? ['!=', null] : ['=', null]) : [1];

        if (auth()->guard('employee')->user()->hasRole('operative_leader|superadmin|operative_leader_aux|night_shift_admin')) {
            $list = $this->cammodelWorkReportInterface->searchCammodelWorkReportsWithIncomes($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin'], $searchData['where']);
        } else {
            $list = $this->cammodelWorkReportInterface->searchSubsidiaryCammodelWorkReportsWithIncomes($searchData['q'], auth()->guard('employee')->user()->subsidiary_id, $searchData['fromOrigin'], $searchData['toOrigin'], $searchData['where']);
        }

        return [
            'data' => [
                'cammodelsWorkReports'     => $list,
                'optionsRoutes'            => config('generals.optionRoutes'),
                'module'                   => $this->module,
                'headers'                  => ['Fecha', 'Modelo', 'Sede', 'Tokens / USD', 'Aprobado', 'Acciones']
            ],
            'search' => $searchData['search']
        ];
    }

    public function createCammodelStreamingIncome(): array
    {
        $not_available_reports = $this->cammodelStreamingIncomeInterface->getAllNotAvailableWorkReportsIds();
        $not_available_fouls   = $this->cammodelFineServiceInterface->getAllNotAvailableFouls();
        $cammodelsFouls = [];
        foreach ($not_available_fouls as $foul) {
            if (!in_array($foul[1], $cammodelsFouls)) {
                $cammodelsFouls[$foul[1]] = [];
            }
            array_push($cammodelsFouls[$foul[1]], $foul[0]);
        }

        //$subsidiary_cammodels = $this->employeeServiceInterface->getSubsidiaryCammodels(auth()->guard("employee")->user()->subsidiary_id);
        $cammodelWorkReports = $this->cammodelWorkReportInterface->getAllCammodelWorkReports()
            ->whereNotIn('id', $not_available_reports)
            ->where('cammodel_payroll_id', null)
            //->whereIn('cammodel_id', $subsidiary_cammodels)
            ->where('disconnection_time', null);

        foreach ($cammodelWorkReports as $key => $item) {
            if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
                if ($item->cammodel->employeeName->subsidiary_id != auth()->guard('employee')->user()->subsidiary_id) {
                    $cammodelWorkReports->forget($key);
                }
            }
        }

        return  [
            'cammodelWorkReports' => $cammodelWorkReports,
            'cammodelFouls'       => $cammodelsFouls,
            'fouls'               => $this->foulInterface->getAllFoulNames()->whereNotIn('id', $not_available_fouls),
            'module'              => $this->module,
            'optionsRoutes'       => config('generals.optionRoutes')
        ];
    }

    public function createOfflineCammodelStreamingIncome(): array
    {
        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $cammodels = $this->cammodelInterface->getSubsidiaryCammodels(auth()->guard('employee')->user()->subsidiary_id);
        } else {
            $cammodels = $this->cammodelInterface->getAllCammodelsWithStreamAccounts();
        }

        return [
            'cammodels'     => $cammodels,
            'module'        => $this->module,
            'optionsRoutes' => $this->optionRoutes
        ];
    }

    public function storeCammodelStreamingIncome(array $requestData)
    {
        $today = Carbon::now()->format('Y-m-d');
        $prevStreamingIncomes = $this->cammodelStreamingIncomeInterface->getPrevStreamingIncomes($today, array_keys($requestData['streamings']));
        $array_prevs = [];
        foreach ($prevStreamingIncomes as $key => $item) {
            $array_prevs[$item->cammodel_stream_account_id] = $item->tokens;
        }

        $dataWorkReport['disconnection_time'] = $requestData['disconnection_time'];
        $workReport = $this->cammodelWorkReportServiceInterface->updateCammodelWorkReport($dataWorkReport, $requestData['cammodel_work_report_id']);

        foreach ($requestData['streamings'] as $key => $streaming_tokens) {

            $data['cammodel_stream_account_id'] = $key;
            $data['created_at']                 = $workReport->created_at;

            $data['tokens'] = array_key_exists($key, $array_prevs) ? $streaming_tokens - $array_prevs[$key] : $streaming_tokens;
            $data['cammodel_work_report_id'] = $requestData['cammodel_work_report_id'];
            $registerExists = $this->cammodelStreamingIncomeInterface->alreadyExists($data['cammodel_stream_account_id'], $data['cammodel_work_report_id']);

            if ($registerExists == null) {
                $data = $this->calculateDollarsAndAccumulated($key, $data);
                $this->storeStreamAccountIncome($data);
            }
        }

        if ($registerExists != null) {
            throw new CreateCammodelStreamingIncomeErrorException('No se pudo crear el ingreso');
        }
    }

    public function storeOfflineCammodelStreamingIncome(array $requestData)
    {
        $cammodel                    = $this->cammodelInterface->findCammodelById($requestData['cammodel_id']);
        $requestData['created_at'] = Carbon::parse($requestData['created_at'] . ' 12:00:00');
        $workReportData['cammodel_id']        = $cammodel->id;
        $workReportData['cammodel_shift_id']  = $cammodel->shift->id;
        $workReportData['shift_id']           = $cammodel->shift->id;
        $workReportData['subsidiary_id']      = $cammodel->employee->subsidiary_id;
        $workReportData['entry_time']         = '06:00:00';
        $workReportData['connection_time']    = '06:00:00';
        $workReportData['disconnection_time'] = '06:00:00';
        $workReportData['created_at']         = $requestData['created_at'];
        $workReportData['updated_at']         = $requestData['created_at'];

        $newWorkReport = $this->cammodelWorkReportInterface->createCammodelWorkReport($workReportData);

        if ($newWorkReport != null) {
            $requestData['cammodel_work_report_id'] = $newWorkReport->id;
        }

        $requestData = $this->calculateDollarsAndAccumulated($requestData['cammodel_stream_account_id'], $requestData);
        $user = $this->toolsInterface->setSignedUser();
        $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
        $this->storeStreamAccountIncome($requestData);
    }

    private function calculateDollarsAndAccumulated(int $cammodelStreamAccountId, array $requestData)
    {
        $streamAccount          = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($cammodelStreamAccountId);
        $requestData['dollars'] = $this->streamingServiceInterface->dollarCalculator($requestData['tokens'], $streamAccount->streamingWithRate->usd_token_rate);
        $periodDate             = $this->toolsInterface->getCammodelStatsPeriodDates();
        $last_tokens            = $this->cammodelStreamingIncomeInterface->getStreamAccountLastAvailableStreamingIncome($cammodelStreamAccountId);
        if ($last_tokens == null) {
            $requestData['accumulated_tokens'] = $requestData['tokens'];
        } else {
            if ($last_tokens->created_at->between($periodDate[0], $periodDate[1]) && $requestData['created_at']->between($periodDate[0], $periodDate[1])) {
                $requestData['accumulated_tokens'] = ($last_tokens == null) ? $requestData['tokens'] : $last_tokens->accumulated_tokens + $requestData['tokens'];
            } elseif (!$last_tokens->created_at->between($periodDate[0], $periodDate[1]) && !$requestData['created_at']->between($periodDate[0], $periodDate[1])) {
                $requestData['accumulated_tokens'] = ($last_tokens == null) ? $requestData['tokens'] : $last_tokens->accumulated_tokens + $requestData['tokens'];
            } else {
                $requestData['accumulated_tokens'] = $requestData['tokens'];
            }
        }

        $requestData['accumulated_dollars'] = $this->streamingServiceInterface->dollarCalculator($requestData['accumulated_tokens'], $streamAccount->streamingWithRate->usd_token_rate);
        return $requestData;
    }

    private function storeStreamAccountIncome(array $data): CammodelStreamingIncome
    {
        return $this->cammodelStreamingIncomeInterface->createCammodelStreamingIncome($data);
    }

    private function update($requestData): bool
    {
        $update = new CammodelStreamingIncomeRepository($this->getCammodelStreamingIncome($requestData['id']));
        return  $update->updateCammodelStreamingIncome($requestData);
    }

    public function updateWorkReportStreamingIncomes($request)
    {
        if ($request->has('streamings')) {

            foreach ($request['streamings'] as $key => $streamAccount) {
                $requestData['cammodel_stream_account_id'] = $streamAccount;
                $requestData['tokens'] = $request['tokens'][$key];
                $this->updateCammodelStreamingIncome($requestData, $request['incomes'][$key]);
            }
        }
    }

    public function updateCammodelStreamingIncome($request, int $id, $assistant = null)
    {
        $actualIncome =  $this->cammodelStreamingIncomeInterface->findCammodelStreamingIncomeById($id);
        $availableCammodelStreamingIncomes = $this->getStreamAccountStreamingIncomes($request['cammodel_stream_account_id'], $actualIncome->created_at);
        $streamAccount = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($request['cammodel_stream_account_id']);
        foreach ($availableCammodelStreamingIncomes as $streamingIncome) {
            $requestData['id']      = $streamingIncome[0];
            $requestData['tokens']  = ($requestData['id'] == $id) ? $request['tokens'] : $streamingIncome[1];
            $requestData['dollars'] = $this->streamingServiceInterface->dollarCalculator($requestData['tokens'], $streamAccount->streamingWithRate->usd_token_rate);

            $last_tokens = $this->cammodelStreamingIncomeInterface->getStreamAccountLastAvailableStreamingIncome($request['cammodel_stream_account_id'], $streamingIncome[2]);
            $periodDate  = $this->toolsInterface->getCammodelStatsPeriodDates();
            if ($last_tokens == null) {
                $requestData['accumulated_tokens'] = $requestData['tokens'];
            } else {
                if ($last_tokens->created_at->between($periodDate[0], $periodDate[1]) && $streamingIncome[2]->between($periodDate[0], $periodDate[1])) {
                    $requestData['accumulated_tokens'] = ($last_tokens == null) ? $requestData['tokens'] : $last_tokens->accumulated_tokens + $requestData['tokens'];
                } elseif (!$last_tokens->created_at->between($periodDate[0], $periodDate[1]) && !$streamingIncome[2]->between($periodDate[0], $periodDate[1])) {
                    $requestData['accumulated_tokens'] = ($last_tokens == null) ? $requestData['tokens'] : $last_tokens->accumulated_tokens + $requestData['tokens'];
                } else {
                    $requestData['accumulated_tokens'] = $requestData['tokens'];
                }
            }
            $requestData['accumulated_dollars'] = $this->streamingServiceInterface->dollarCalculator($requestData['accumulated_tokens'], $streamAccount->streamingWithRate->usd_token_rate);

            if (array_key_exists('user_approves', $requestData)) {
                unset($requestData['user_approves']);
            }

            if ($requestData['id'] == $id) {
                $user = auth()->guard('employee')->user();

                if ($assistant == null) {
                    $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
                }
            }

            $this->update($requestData);
        }
    }

    public function destroyCammodelStreamingIncome(int $id): bool
    {
        $update = new CammodelStreamingIncomeRepository($this->getCammodelStreamingIncome($id));
        return $update->deleteCammodelStreamingIncome();
    }

    private function getCammodelStreamingIncome(int $id): CammodelStreamingIncome
    {
        return $this->cammodelStreamingIncomeInterface->findCammodelStreamingIncomeById($id);
    }

    private function getStreamAccountStreamingIncomes($streamAccount, $createdAt): array
    {
        $periodDate = $this->toolsInterface->getPastFortnightDates(0);
        if (Carbon::parse($periodDate[0])->diffInMinutes($createdAt->copy(), false) < 0) {
            $periodDate = $this->toolsInterface->getPastFortnightDates(1);
        }

        $idsCollection = $this->cammodelStreamingIncomeInterface->getCammodelStreamingIncomes($streamAccount, $periodDate, $createdAt);

        $ids_array = [];
        foreach ($idsCollection as $value) {
            array_push($ids_array, [$value->id, $value->tokens, $value->created_at]);
        }

        return $ids_array;
    }

    public function getApiStreamingIncomes()
    {
        $this->getStudioBongacamsIncomes();
        $chaturbateMasterAccounts = new ChaturbateMasterAccount();
        $masterAccounts = $chaturbateMasterAccounts->getMasterAccounts();
        $masterTokens = $chaturbateMasterAccounts->getMasterTokens();
        $otherAccounts = $chaturbateMasterAccounts->getOtherAccountsIds();
        foreach ($masterAccounts as $key => $masterAccount) {
            $this->getStudioChaturbateIncomes($masterAccount, $masterTokens[$key]);
        }
        foreach ($otherAccounts as $account) {
            $streamAccount = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($account);
            $apiData = $this->getCammodelChaturbateStats($streamAccount->account_api_token);
            $this->updateCammodelChaturbateIncomes($account, $apiData['token_balance']);
        }
    }

    private function updateCammodelChaturbateIncomes(int $accountId, $tokens)
    {
        $streamAccount = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($accountId);

        if ($streamAccount != null) {
            $from = now()->subDays(1)->format('Y-m-d');

            $streamingIncome = $this->cammodelStreamingIncomeInterface->findFromStreamAccount($accountId, $from);
            if ($streamingIncome) {
                $lastAccountIncome = $this->cammodelStreamingIncomeInterface->getStreamAccountLastAvailableStreamingIncome($accountId, $streamingIncome->created_at);
                if ($lastAccountIncome != null) {
                    $fixed_tokens = $tokens - intval($lastAccountIncome['accumulated_tokens']);
                } else {
                    $fixed_tokens = $tokens;
                }
                $requestData['cammodel_stream_account_id'] = $accountId;
                $requestData['tokens'] = $fixed_tokens;
                $this->updateCammodelStreamingIncome($requestData, $streamingIncome->id, 1);
            } else {
                $this->storeStreamingIncome($accountId, $tokens);
            }
        }
    }

    private function getStudioChaturbateIncomes(string $masterAccount, string $masterToken)
    {
        $apiData = $this->getStudioChaturbateStats($masterAccount, $masterToken);

        if (!empty($apiData) && array_key_exists('stats', $apiData)) {
            if (!empty($apiData['stats'])) {
                if (array_key_exists(1, $apiData['stats'])) {
                    if ($apiData['stats'][1]['rows'][0][0] == 'maschichaslindas') {
                        $chaturbateIncomes = $apiData['stats'][0]['rows'];
                    } else {
                        $chaturbateIncomes = $apiData['stats'][1]['rows'];
                    }
                } else {
                    $chaturbateIncomes = $apiData['stats'][0]['rows'];
                }
                foreach ($chaturbateIncomes as $cammodelIncomes) {
                    $chaturbateAccount = $this->cammodelStreamAccountInterface
                        ->findStreamingAccountByProfile($cammodelIncomes[0]);
                    if ($chaturbateAccount != null) {
                        $this->updateStreamAccountIncome($chaturbateAccount->id, $cammodelIncomes[1]);
                    }
                }
            }
        }
    }

    private function getStudioBongacamsIncomes()
    {
        $bongaStats = [];
        $bongaAccounts = $this->cammodelStreamAccountInterface->getAccountsByStreaming(5);
        foreach ($bongaAccounts as $bongaAccount) {
            $apiData = $this->getStudioBongacamsStats($bongaAccount);
            if (array_key_exists('username', $apiData) && array_key_exists('no_percentage_rate_income', $apiData)) {
                if (intval($apiData['no_percentage_rate_income']) > 0) {
                    $this->updateStreamAccountIncome($bongaAccount->id, $apiData['no_percentage_rate_income']);
                }
            }
            array_push($bongaStats, $apiData);
        }
    }

    private function getStudioBongacamsStats($bongaAccount)
    {
        // token bonga : 0yw6ck02vjj8yqwu0jgqimr
        // https://es.bongamodels.com/studio-api-faq
        $day   = today()->subDays(1)->day;
        $month = today()->subDays(1)->month;
        $year  = today()->subDays(1)->year;
        $bongaApiUrl = 'https://bongacams.com/api/v1/stats/model-regular-earnings?' .
            'username=' . $bongaAccount->user .
            '&date_from=' . $year . '-' . $month . '-' . $day .
            '&date_to=' . $year . '-' . $month . '-' . $day;
        $apiKey = '0yw6ck02vjj8yqwu0jgqimr';
        $headers = array(
            'Content-Type:application/json',
            'ACCESS-KEY:' . $apiKey
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $bongaApiUrl);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

    private function getStudioChaturbateStats(string $account, string $token)
    {
        $day   = today()->subDays(1)->day;
        $month = today()->subDays(1)->month;
        $year  = today()->subDays(1)->year;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // https://es.chaturbate.com/affiliates/apistats/?username=maschichaslindas&token=53568wfpF6IH4AwfIY8KAwbv&stats_breakdown=sub_account__username&campaign=&search_criteria=1&period=0&date_day=27&date_month=2&date_year=2022&start_date_day=1&start_date_month=1&start_date_year=2021&end_date_day=28&end_date_month=2&end_date_year=2021&download_stats_json=Download%20Stats%20as%20JSON
        curl_setopt($ch, CURLOPT_URL, 'https://es.chaturbate.com/affiliates/apistats/?' .
            'username=' . $account .
            '&token=' . $token .
            '&stats_breakdown=sub_account__username' .
            '&campaign=' .
            '&search_criteria=2' .
            '&period=1' .
            '&date_day=' . $day .
            '&date_month=' . $month .
            '&date_year=' . $year .
            '&start_date_day=16' .
            '&start_date_month=3' .
            '&start_date_year=2021' .
            '&end_date_day=23' .
            '&end_date_month=3' .
            '&end_date_year=2021' .
            '&download_stats_json=Download%20Stats%20as%20JSON');
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

    private function getCammodelChaturbateStats(string $tokenUrl)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        return $result;
    }

    private function updateStreamAccountIncome($streamingAccount, $tokens)
    {
        $from = now()->subDays(1)->format('Y-m-d');

        $streamingIncome = $this->cammodelStreamingIncomeInterface->findFromStreamAccount($streamingAccount, $from);

        if ($streamingIncome) {
            $requestData['cammodel_stream_account_id'] = $streamingAccount;
            $requestData['tokens'] = $tokens;
            $this->updateCammodelStreamingIncome($requestData, $streamingIncome->id, 1);
        } else {
            $this->storeStreamingIncome($streamingAccount, $tokens);
        }
    }

    private function storeStreamingIncome($streamingAccount, $tokens)
    {
        $periodDate = $this->toolsInterface->getCammodelStatsPeriodDates();
        $created_date = now()->subDay();
        $data['cammodel_stream_account_id'] = $streamingAccount;
        $data['created_at']                 = $created_date;

        $data['tokens'] = $tokens;

        $streamAccount               = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($streamingAccount);
        $cammodel                    = $this->cammodelInterface->findCammodelById($streamAccount->cammodel->id);

        $workReportData['cammodel_id']        = $cammodel->id;
        $workReportData['cammodel_shift_id']  = $cammodel->shift->id;
        $workReportData['shift_id']           = $cammodel->shift->id;
        $workReportData['subsidiary_id']      = $cammodel->employee->subsidiary_id;
        $workReportData['entry_time']         = '06:00:00';
        $workReportData['connection_time']    = '06:00:00';
        $workReportData['disconnection_time'] = '06:00:00';
        $workReportData['created_at']         = $created_date;
        $workReportData['updated_at']         = $created_date;

        $newWorkReport = $this->cammodelWorkReportInterface->createCammodelWorkReport($workReportData);

        if ($newWorkReport != null) {
            $data['cammodel_work_report_id'] = $newWorkReport->id;
        }

        $data['dollars']             = $this->streamingServiceInterface->dollarCalculator($data['tokens'], $streamAccount->streamingWithRate->usd_token_rate);
        $last_tokens                 = $this->cammodelStreamingIncomeInterface->getStreamAccountLastAvailableStreamingIncome($streamingAccount);
        if ($last_tokens == null) {
            $data['accumulated_tokens'] = $data['tokens'];
        } else {
            if ($last_tokens->created_at->between($periodDate[0], $periodDate[1]) && $created_date->between($periodDate[0], $periodDate[1])) {
                $data['accumulated_tokens'] = ($last_tokens == null) ? $data['tokens'] : $last_tokens->accumulated_tokens + $data['tokens'];
            } elseif (!$last_tokens->created_at->between($periodDate[0], $periodDate[1]) && !$created_date->between($periodDate[0], $periodDate[1])) {
                $data['accumulated_tokens'] = ($last_tokens == null) ? $data['tokens'] : $last_tokens->accumulated_tokens + $data['tokens'];
            } else {
                $data['accumulated_tokens'] = $data['tokens'];
            }
        }
        $data['accumulated_dollars'] = $this->streamingServiceInterface->dollarCalculator($data['accumulated_tokens'], $streamAccount->streamingWithRate->usd_token_rate);
        $this->cammodelStreamingIncomeInterface->createCammodelStreamingIncome($data);
    }
}
