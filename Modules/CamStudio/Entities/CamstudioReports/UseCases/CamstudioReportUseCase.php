<?php

namespace Modules\CamStudio\Entities\CamstudioReports\UseCases;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces\CammodelPayrollUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces\CammodelUseCaseInterface;
use Modules\CamStudio\Entities\CamstudioReports\UseCases\Interfaces\CamstudioReportUseCaseInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\Interfaces\CamstudioReportCommentaryUseCaseInterface;
use Modules\Companies\Entities\Employees\Exceptions\NoShiftAssignedException;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\Kpis\Repositories\Interfaces\KpiRepositoryInterface;

class CamstudioReportUseCase implements CamstudioReportUseCaseInterface
{
    private $toolsInterface, $cammodelPayrollServiceInterface, $kpiInterface;
    private $shiftInterface, $camstudioReportCommentaryServiceInterface;
    private $cammodelServiceInterface, $cammodelStreamingIncomesInterface;
    private $employeeInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelUseCaseInterface $cammodelUseCaseInterface,
        CammodelPayrollUseCaseInterface $cammodelPayrollUseCaseInterface,
        CammodelStreamingIncomeRepositoryInterface $cammodelStreamingIncomeRepositoryInterface,
        CamstudioReportCommentaryUseCaseInterface $camstudioReportCommentaryUseCaseInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        KpiRepositoryInterface $kpiRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface
    ) {
        $this->toolsInterface                            = $toolRepositoryInterface;
        $this->cammodelServiceInterface                  = $cammodelUseCaseInterface;
        $this->cammodelPayrollServiceInterface           = $cammodelPayrollUseCaseInterface;
        $this->cammodelStreamingIncomesInterface         = $cammodelStreamingIncomeRepositoryInterface;
        $this->camstudioReportCommentaryServiceInterface = $camstudioReportCommentaryUseCaseInterface;
        $this->employeeInterface                         = $employeeRepositoryInterface;
        $this->kpiInterface                              = $kpiRepositoryInterface;
        $this->shiftInterface                            = $shiftRepositoryInterface;
        $this->module                                    = 'Reportes Studio';
    }

    public function monthCamstudioClosingReport(Request $request)
    {
        $filtersData   = $this->getFiltersData($request);
        $fortnightsGap = $this->toolsInterface->getFortnightsGap($request);
        $dates         = $this->toolsInterface->getPastFortnightDates($fortnightsGap);
        $from          = $dates[0];
        $to            = $dates[1];

        $actualCammodelsLiquidations = $this->cammodelPayrollServiceInterface
            ->getPeriodCammodelsLiquidations($dates, $filtersData);

        $pastDates = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 1);

        $pastCammodelsLiquidations = $this->cammodelPayrollServiceInterface
            ->getPeriodCammodelsLiquidations($pastDates, $filtersData);

        if (Carbon::parse($from)->day == 16) {
            $actualCompoundLiquidations = $this
                ->periodCompoundCammodelLiquidations($actualCammodelsLiquidations->concat($pastCammodelsLiquidations))
                ->sortByDesc('total_usd_cammodel');
        } else {
            $actualCompoundLiquidations = $this
                ->periodCompoundCammodelLiquidations($actualCammodelsLiquidations)
                ->sortByDesc('total_usd_cammodel');
        }

        $pastMonthLiquidations = $this->getPastMonthLiquidations(Carbon::parse($from)->day, $fortnightsGap, $filtersData);

        $workReportsLiquidations = $this->getWorkReportsLiquidations(
            $pastMonthLiquidations,
            $actualCammodelsLiquidations->concat($pastCammodelsLiquidations)
        );

        $pastMonthLiquidations = $this->periodCompoundCammodelLiquidations($pastMonthLiquidations);

        $platformsLiquidations = $this->getPlatformsLiquidations(
            $this->onlyIncomes($pastCammodelsLiquidations),
            new Collection(),
            $this->onlyIncomes($pastCammodelsLiquidations),
        );

        $from     = Carbon::parse($from);
        $to       = Carbon::parse($to)->day == 1 ?
            Carbon::parse($to)->subDay() :
            Carbon::parse($to);
        $pastTo   = Carbon::parse($pastDates[1])->day == 1 ?
            Carbon::parse($pastDates[1])->subDay() :
            Carbon::parse($pastDates[1]);
        $pastFrom = Carbon::parse($pastDates[0]);

        $periodIncomes = $this->getPeriodIncomes(1, $fortnightsGap, $filtersData);

        $actualFortnight = [
            $from->copy()->day,
            $to->copy()->day,
            $this->toolsInterface->getMonthName($from->copy()->month),
            $this->toolsInterface->getMonthName($from->copy()->subMonth()->month)
        ];

        $pastFortnight = [
            $pastFrom->copy()->day,
            $pastTo->copy()->day,
            $this->toolsInterface->getMonthName($pastFrom->copy()->month)
        ];

        return [
            'data' => [
                'module'                        => $this->module,
                'optionsRoutes'                 => config('generals.optionRoutes'),
                'actualCammodelsLiquidations'   => $actualCammodelsLiquidations->sortByDesc('total_usd_cammodel'),
                'actualLiquidationsTotal'       => $actualCammodelsLiquidations->sum('total_usd_cammodel'),
                'pastCammodelsLiquidations'     => $pastCammodelsLiquidations->sortByDesc('total_usd_cammodel'),
                'pastLiquidationsTotal'         => $pastCammodelsLiquidations->sum('total_usd_cammodel'),
                'compoundCammodelsLiquidations' => $this->getCompoundLiquidations($actualCompoundLiquidations, $pastMonthLiquidations),
                'monthsTotalUsd'                => $this->periodsTotal($pastMonthLiquidations, $actualCompoundLiquidations),
                'subsidiaryMonthsTotal'         => $periodIncomes[3],
                'cammodelShiftMonthsTotal'      => $this->cammodelShiftsLiquidations($pastMonthLiquidations, $actualCompoundLiquidations),
                'roomsMonthsTotal'              => $periodIncomes[0],
                'managersMonthsTotal'           => $periodIncomes[1],
                'workReportShiftMonthsTotal'    => $periodIncomes[2],
                'platformsMonthsTotal'          => $workReportsLiquidations[3],
                'platformsPrevTotal'            => $platformsLiquidations,
                'actualFortnight'               => $actualFortnight,
                'pastFortnight'                 => $pastFortnight,
                'cammodels'                     => $this->cammodelServiceInterface->getCammodelNames($filtersData),
                'commentaries'                  => $this->camstudioReportCommentaryServiceInterface->listCamstudioReportCommentaries(
                    [
                        Carbon::parse($dates[0])->startOfMonth()->format('Y-m-d H:i:s'),
                        Carbon::parse($dates[0])->endOfMonth()->format('Y-m-d H:i:s')
                    ],
                    'month'
                )
            ]
        ];
    }

    private function getPastMonthLiquidations($fortnightStart, int $fortnightsGap, array $filtersData)
    {
        if ($fortnightStart == 1) {
            $firstDates  = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 1);
            $secondDates = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 2);
        } else {
            $firstDates  = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 2);
            $secondDates = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 3);
        }

        $firstFortnightLiquidations = $this->cammodelPayrollServiceInterface
            ->getPeriodCammodelsLiquidations($firstDates, $filtersData);

        $secondFortnightLiquidations = $this->cammodelPayrollServiceInterface
            ->getPeriodCammodelsLiquidations($secondDates, $filtersData);

        return $firstFortnightLiquidations->concat($secondFortnightLiquidations);
    }

    public function trimesterCamstudioClosingReport(Request $request)
    {
        $actualTrimesterPosition = $this->toolsInterface->getTrimesterPosition($request->except(['_token', '_method']));
        $filtersData             = $this->getFiltersData($request);

        $firstTrimesterMonth = intVal(((ceil($actualTrimesterPosition[0]) - 1) * 3) + 1);
        $firstMonth = $firstTrimesterMonth < 10 ?
            $actualTrimesterPosition[1] . '-0' . $firstTrimesterMonth :
            $actualTrimesterPosition[1] . '-' . $firstTrimesterMonth;

        $fortnightsGap = $this->toolsInterface->getFortnightsGap(collect(['month' => $firstMonth]));
        $fortnightsGap = $firstTrimesterMonth != now()->month ?
            $fortnightsGap + 1 :
            $fortnightsGap;

        $this->getPeriodIncomes(0, $fortnightsGap, $filtersData);


        $monthsLiquidations = $this->getTrimesterLiquidations($fortnightsGap, $filtersData);
        $monthsLiquidationsConcat = $monthsLiquidations[0]->concat($monthsLiquidations[1]->concat(
            $monthsLiquidations[2]
        ));

        $prevTrimesterLiquidations = $this->getTrimesterLiquidations($fortnightsGap + 6, $filtersData);
        $prevTrimesterLiquidationsConcat = $prevTrimesterLiquidations[0]->concat($prevTrimesterLiquidations[1]->concat(
            $prevTrimesterLiquidations[2]
        ));

        $actualTrimesterCompoundLiquidations = $this
            ->periodCompoundCammodelLiquidations($monthsLiquidationsConcat)->sortByDesc('total_usd_cammodel');

        $prevTrimesterCompoundLiquidations = $this
            ->periodCompoundCammodelLiquidations($prevTrimesterLiquidationsConcat);

        $workReportsLiquidations = $this
            ->getWorkReportsLiquidations($prevTrimesterLiquidationsConcat, $monthsLiquidationsConcat);

        $monthsNames = [
            'firstMonthName'  => $this->toolsInterface->getMonthName($firstTrimesterMonth),
            'secondMonthName' => $this->toolsInterface->getMonthName($firstTrimesterMonth + 1),
            'thirdMonthName'  => $this->toolsInterface->getMonthName($firstTrimesterMonth + 2)
        ];

        $firstMonthPrevTrimester = Carbon::parse($firstMonth . '-01')->subMonths(3);

        $fullMonthsNames = [
            0,
            0,
            $monthsNames['firstMonthName'] . ' a ' . $monthsNames['thirdMonthName'],
            $this->toolsInterface->getMonthName($firstMonthPrevTrimester->copy()->month) . ' a ' .
                $this->toolsInterface->getMonthName($firstMonthPrevTrimester->copy()->addMonths(2)->month)
        ];
        $periodIncomes = $this->getPeriodIncomes(0, $fortnightsGap, $filtersData);

        return [
            'data' => [
                'module'                        => $this->module,
                'optionsRoutes'                 => config('generals.optionRoutes'),
                'firstMonthLiquidations'        => $monthsLiquidations[0]->sortByDesc('total_usd_cammodel'),
                'firstMonthTotal'               => $monthsLiquidations[0]->sum('total_usd_cammodel'),
                'secondMonthLiquidations'       => $monthsLiquidations[1]->sortByDesc('total_usd_cammodel'),
                'secondMonthTotal'              => $monthsLiquidations[1]->sum('total_usd_cammodel'),
                'thirdMonthLiquidations'        => $monthsLiquidations[2]->sortByDesc('total_usd_cammodel'),
                'thirdMonthTotal'               => $monthsLiquidations[2]->sum('total_usd_cammodel'),
                'compoundCammodelsLiquidations' => $this->getCompoundLiquidations($actualTrimesterCompoundLiquidations, $prevTrimesterCompoundLiquidations),
                'monthsTotalUsd'                => $this->periodsTotal($prevTrimesterCompoundLiquidations, $actualTrimesterCompoundLiquidations),
                'subsidiaryMonthsTotal'         => $periodIncomes[3],
                'cammodelShiftMonthsTotal'      => $this->cammodelShiftsLiquidations($prevTrimesterCompoundLiquidations, $actualTrimesterCompoundLiquidations),
                'roomsMonthsTotal'              => $periodIncomes[0],
                'managersMonthsTotal'           => $periodIncomes[1],
                'workReportShiftMonthsTotal'    => $periodIncomes[2],
                'platformsMonthsTotal'          => $workReportsLiquidations[3],
                'monthsNames'                   => $monthsNames,
                'cammodels'                     => $this->cammodelServiceInterface->getCammodelNames($filtersData),
                'actualFortnight'               => $fullMonthsNames,
                'commentaries'                  => $this->camstudioReportCommentaryServiceInterface->listCamstudioReportCommentaries(
                    [
                        Carbon::parse($firstMonth)->startOfMonth()->format('Y-m-d H:i:s'),
                        Carbon::parse($firstMonth)->addMonths(2)->endOfMonth()->format('Y-m-d H:i:s')
                    ],
                    'trimester'
                )
            ]
        ];
    }

    private function getTrimesterLiquidations($fortnightsGap, $filtersData)
    {
        $monthsLiquidations = [];

        for ($i = 0; $i < 3; $i++) {
            $firstFortnightMonthDates = $this->toolsInterface
                ->getPastFortnightDates($fortnightsGap - (2 * $i));

            $firstFortnightMonthLiquidations = $this->cammodelPayrollServiceInterface
                ->getPeriodCammodelsLiquidations($firstFortnightMonthDates, $filtersData);

            $secondFortnightMonthDates = $this->toolsInterface
                ->getPastFortnightDates(($fortnightsGap - (2 * $i)) - 1);

            $secondFortnightMonthLiquidations = $this->cammodelPayrollServiceInterface
                ->getPeriodCammodelsLiquidations($secondFortnightMonthDates, $filtersData);

            $monthLiquidations = $firstFortnightMonthLiquidations->concat($secondFortnightMonthLiquidations);
            $monthLiquidations = $monthLiquidations->groupBy('cammodel_id')->map(function ($item) {
                $incomes = $item->has(1) ?
                    array_merge($item[0]['incomes'], $item[1]['incomes']) :
                    $item[0]['incomes'];
                return [
                    "cammodel_id"        => $item[0]['cammodel_id'],
                    "cammodel"           => $item[0]['cammodel'],
                    "incomes"            => $incomes,
                    "total_usd_cammodel" => $item->sum(['total_usd_cammodel']),
                ];
            });

            array_push($monthsLiquidations, $monthLiquidations);
        }

        return $monthsLiquidations;
    }

    private function getFiltersData($request)
    {
        if ($request->has('subsidiary_id')) {
            $subsidiaryId = $request['subsidiary_id'];
        } else {
            $subsidiaryId = null;
        }

        if ($request->has('cammodel_id')) {
            $cammodelId = $request['cammodel_id'];
        } else {
            $cammodelId = null;
        }

        return [
            'subsidiary_id' => $subsidiaryId,
            'cammodel_id'   => $cammodelId
        ];
    }

    private function periodCompoundCammodelLiquidations($compoundLiquidations)
    {
        $compoundCammodelLiquidations = $compoundLiquidations->groupBy('cammodel_id');

        return $compoundCammodelLiquidations->map(function ($item, $key) {
            return [
                'cammodel_id'        => $item[0]['cammodel_id'],
                'cammodel'           => $item[0]['cammodel'],
                'total_usd_cammodel' => $item->sum('total_usd_cammodel'),
            ];
        });
    }

    private function periodsTotal($firstPeriodLiquidations, $secondPeriodLiquidations)
    {
        $firstPeriodTotal  = $firstPeriodLiquidations->sum('total_usd_cammodel');
        $secondPeriodTotal = $secondPeriodLiquidations->sum('total_usd_cammodel');

        return [
            'first_month_total'  => $firstPeriodTotal,
            'second_month_total' => $secondPeriodTotal,
            'change_rate'        => $this->toolsInterface->calculateChangeRate($secondPeriodTotal, $firstPeriodTotal)
        ];
    }

    private function getCompoundLiquidations($actualCompoundLiquidations, $prevPeriodLiquidations)
    {
        $falseCompoundLiquidations = $actualCompoundLiquidations->concat($prevPeriodLiquidations)->groupBy('cammodel_id');

        $compoundCammodelLiquidations = new Collection();
        foreach ($falseCompoundLiquidations as $key => $cammodel) {
            if (!$compoundCammodelLiquidations->has($key)) {
                $compoundCammodelLiquidations->put($key, []);
            }
            $periodLiquidations = [];
            $periodLiquidations[0] = $prevPeriodLiquidations->has($key) ?
                $prevPeriodLiquidations[$key]['total_usd_cammodel'] :
                0;

            $periodLiquidations[1] = $actualCompoundLiquidations->has($key) ?
                $actualCompoundLiquidations[$key]['total_usd_cammodel'] :
                0;

            $compoundCammodelLiquidations[$key] = [
                'cammodel'         => $cammodel[0]['cammodel'],
                'past_month_usd'   => $periodLiquidations[0],
                'actual_month_usd' => $periodLiquidations[1],
                'change_rate'      => $this->toolsInterface->calculateChangeRate($periodLiquidations[1], $periodLiquidations[0])
            ];
        }

        return $compoundCammodelLiquidations;
    }

    private function cammodelShiftsLiquidations($firstPeriodLiquidations, $secondPeriodLiquidations)
    {
        $falseCompoundLiquidations = $secondPeriodLiquidations
            ->concat($firstPeriodLiquidations)
            ->groupBy(function ($item) {
                return $item['cammodel']->shift_id;
            });

        $actualPeriodShiftTotal = $secondPeriodLiquidations
            ->groupBy(function ($item) {
                return $item['cammodel']->shift_id;
            });

        $pastPeriodShiftTotal = $firstPeriodLiquidations
            ->groupBy(function ($item) {
                return $item['cammodel']->shift_id;
            });

        $cammodelShiftsLiquidations = $falseCompoundLiquidations->map(function ($item, $key)
        use ($actualPeriodShiftTotal, $pastPeriodShiftTotal) {

            $shift = $this->shiftInterface
                ->findShiftById($item[0]['cammodel']->shift_id);

            $firstPeriodTotal = $pastPeriodShiftTotal->has($key) ?
                $pastPeriodShiftTotal[$key]->sum('total_usd_cammodel') :
                0;

            $secondPeriodTotal = $actualPeriodShiftTotal->has($key) ?
                $actualPeriodShiftTotal[$key]->sum('total_usd_cammodel') :
                0;

            return [
                'shift_name'       => $shift->name,
                'first_month_usd'  => $firstPeriodTotal,
                'second_month_usd' => $secondPeriodTotal,
                'change_rate'      => $this->toolsInterface->calculateChangeRate($secondPeriodTotal, $firstPeriodTotal)
            ];
        });

        return $cammodelShiftsLiquidations->sortByDesc('second_month_usd');
    }

    private function getWorkReportsLiquidations($firstPeriodLiquidations, $secondPeriodLiquidations)
    {
        $firstPeriodIncomes = $this->onlyIncomes($firstPeriodLiquidations);

        $secondPeriodIncomes = $this->onlyIncomes($secondPeriodLiquidations);

        $falseIncomes = $secondPeriodIncomes
            ->concat($firstPeriodIncomes);

        $shiftsLiquidations   = $this->getShiftsLiquidations($firstPeriodIncomes, $secondPeriodIncomes, $falseIncomes);
        $platformsLiquidations = $this->getPlatformsLiquidations($firstPeriodIncomes, $secondPeriodIncomes, $falseIncomes);

        return [$shiftsLiquidations, 0, 0, $platformsLiquidations];
    }

    private function onlyIncomes($liquidations)
    {
        $temporaryCollection = new Collection();
        foreach ($liquidations as $liquidation) {
            foreach ($liquidation['incomes'] as $income) {
                $temporaryCollection->push($income);
            }
        }

        return $temporaryCollection;
    }

    private function getShiftsLiquidations($actualPeriodIncomes, $prevPeriodIncomes)
    {
        $actualPeriodIncomes = $actualPeriodIncomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                return $item['cammodelWorkReport']->shift_id;
            }
            return "offline";
        })->forget("offline");

        $actualPeriodIncomes = $actualPeriodIncomes
            ->map(function ($item) {
                return [
                    'shift'   => $item[0]->cammodelWorkReport->shift,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $prevPeriodIncomes = $prevPeriodIncomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                return $item['cammodelWorkReport']->shift_id;
            }
            return "offline";
        })->forget("offline");

        $prevPeriodIncomes = $prevPeriodIncomes
            ->map(function ($item) {
                return [
                    'shift'   => $item[0]->cammodelWorkReport->shift,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $shiftsLiquidations = $actualPeriodIncomes->concat($prevPeriodIncomes)->groupBy('shift.id')
            ->map(function ($item, $key) use ($actualPeriodIncomes, $prevPeriodIncomes) {
                $actualPeriodDollars = $actualPeriodIncomes->has($key) ?
                    $actualPeriodIncomes[$key]['dollars'] :
                    0;

                $prevPeriodDollars = $prevPeriodIncomes->has($key) ?
                    $prevPeriodIncomes[$key]['dollars'] :
                    0;

                if ($key != "offline") {
                    $shiftName = $item[0]['shift']->name;
                } else {
                    $shiftName = "----";
                }

                return [
                    'shift_name'            => $shiftName,
                    'actual_period_dollars' => $actualPeriodDollars,
                    'prev_period_dollars'   => $prevPeriodDollars,
                    'change_rate'           => $this->toolsInterface->calculateChangeRate($actualPeriodDollars, $prevPeriodDollars)
                ];
            });

        return $shiftsLiquidations->sortByDesc('second_month_usd');
    }

    private function getRoomsLiquidations($actualPeriodIncomes, $prevPeriodIncomes)
    {
        $actualPeriodIncomes = $this->groupByRoomId($actualPeriodIncomes)->forget("offline");
        $actualPeriodIncomes = $actualPeriodIncomes
            ->map(function ($item) {
                return [
                    'room'    => $item[0]->cammodelWorkReport->room,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $prevPeriodIncomes = $this->groupByRoomId($prevPeriodIncomes)->forget("offline");
        $prevPeriodIncomes = $prevPeriodIncomes
            ->map(function ($item) {
                return [
                    'room'    => $item[0]->cammodelWorkReport->room,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $roomsLiquidations = $actualPeriodIncomes->concat($prevPeriodIncomes)->groupBy('room.id')
            ->map(function ($item, $key) use ($actualPeriodIncomes, $prevPeriodIncomes) {
                $actualPeriodDollars = $actualPeriodIncomes->has($key) ?
                    $actualPeriodIncomes[$key]['dollars'] :
                    0;

                $prevPeriodDollars = $prevPeriodIncomes->has($key) ?
                    $prevPeriodIncomes[$key]['dollars'] :
                    0;

                if ($key != "offline") {
                    $roomId         = $item[0]['room']->id;
                    $roomName       = $item[0]['room']->name;
                    $subsidiaryName = $item[0]['room']->subsidiary->name;
                    $subsidiaryId   = $item[0]['room']->subsidiary->id;
                } else {
                    $roomId         = 0;
                    $roomName       = "----";
                    $subsidiaryName = "----";
                    $subsidiaryId   = 0;
                }

                return [
                    'room_id'               => $roomId,
                    'room_name'             => $roomName,
                    'subsidiary_name'       => $subsidiaryName,
                    'subsidiary_id'         => $subsidiaryId,
                    'actual_period_dollars' => $actualPeriodDollars,
                    'prev_period_dollars'   => $prevPeriodDollars,
                    'change_rate'           => $this->toolsInterface->calculateChangeRate($actualPeriodDollars, $prevPeriodDollars)
                ];
            });

        return $roomsLiquidations->sortBy('subsidiary_id');
    }

    private function groupByRoomId($incomes)
    {
        return $incomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                if ($item['cammodelWorkReport']->room != null) {
                    return $item['cammodelWorkReport']->room_id;
                }
                return "offline";
            }
            return "offline";
        });
    }

    private function groupByManagerId($incomes)
    {
        return $incomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                if ($item['cammodelWorkReport']->manager != null) {
                    return $item['cammodelWorkReport']->manager_id;
                }
                return 0;
            }
            return 0;
        });
    }

    private function getManagersLiquidations($actualPeriodIncomes, $prevPeriodIncomes)
    {
        $actualPeriodIncomes = $this->groupByManagerId($actualPeriodIncomes)->forget(0);
        $actualPeriodIncomes = $actualPeriodIncomes
            ->map(function ($item) {
                return [
                    'manager' => $item[0]->cammodelWorkReport->manager,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $prevPeriodIncomes = $this->groupByManagerId($prevPeriodIncomes)->forget(0);
        $prevPeriodIncomes = $prevPeriodIncomes
            ->map(function ($item) {
                return [
                    'manager' => $item[0]->cammodelWorkReport->manager,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $managersLiquidations = $actualPeriodIncomes->concat($prevPeriodIncomes)->groupBy('manager.id')
            ->map(function ($item, $key) use ($actualPeriodIncomes, $prevPeriodIncomes) {
                $actualPeriodDollars = $actualPeriodIncomes->has($key) ?
                    $actualPeriodIncomes[$key]['dollars'] :
                    0;

                $prevPeriodDollars = $prevPeriodIncomes->has($key) ?
                    $prevPeriodIncomes[$key]['dollars'] :
                    0;

                return [
                    'manager_id'            => $item[0]['manager']->id,
                    'manager_name'          => $item[0]['manager']->name . ' ' . $item[0]['manager']->last_name,
                    'actual_period_dollars' => $actualPeriodDollars,
                    'prev_period_dollars'   => $prevPeriodDollars,
                    'change_rate'           => $this->toolsInterface->calculateChangeRate($actualPeriodDollars, $prevPeriodDollars)
                ];
            });

        return $managersLiquidations->sortByDesc('actual_period_dollars');
    }

    private function getSubsidiaryLiquidations($actualPeriodIncomes, $prevPeriodIncomes)
    {
        $actualPeriodIncomes = $actualPeriodIncomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                return $item['cammodelWorkReport']->subsidiary_id;
            }
            return "offline";
        })->forget("offline");

        $actualPeriodIncomes = $actualPeriodIncomes
            ->map(function ($item) {
                return [
                    'subsidiary'   => $item[0]->cammodelWorkReport->subsidiary,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $prevPeriodIncomes = $prevPeriodIncomes->groupBy(function ($item) {
            if ($item['cammodelWorkReport'] != null) {
                return $item['cammodelWorkReport']->subsidiary_id;
            }
            return "offline";
        })->forget("offline");

        $prevPeriodIncomes = $prevPeriodIncomes
            ->map(function ($item) {
                return [
                    'subsidiary'   => $item[0]->cammodelWorkReport->subsidiary,
                    'dollars' => $item->sum('dollars') / 2,
                ];
            });

        $subsidiaryLiquidations = $actualPeriodIncomes->concat($prevPeriodIncomes)->groupBy('subsidiary.id')
            ->map(function ($item, $key) use ($actualPeriodIncomes, $prevPeriodIncomes) {
                $actualPeriodDollars = $actualPeriodIncomes->has($key) ?
                    $actualPeriodIncomes[$key]['dollars'] :
                    0;

                $prevPeriodDollars = $prevPeriodIncomes->has($key) ?
                    $prevPeriodIncomes[$key]['dollars'] :
                    0;

                return [
                    'subsidiary_id'    => $item[0]['subsidiary']->id,
                    'subsidiary_name'  => $item[0]['subsidiary']->name,
                    'first_month_usd'  => $prevPeriodDollars,
                    'second_month_usd' => $actualPeriodDollars,
                    'change_rate'      => $this->toolsInterface->calculateChangeRate($actualPeriodDollars, $prevPeriodDollars)
                ];
            });

        return $subsidiaryLiquidations->sortByDesc('second_month_usd');
    }

    private function getPlatformsLiquidations($firstPeriodIncomes, $secondPeriodIncomes, $falseIncomes)
    {
        $falsePlatformsLiquidations = $this->groupByPlatform($falseIncomes);

        $firstPeriodPlatformsLiquidations = $this->groupByPlatform($firstPeriodIncomes);

        $secondPeriodPlatformsLiquidations = $this->groupByPlatform($secondPeriodIncomes);

        $platformsLiquidations = $falsePlatformsLiquidations->map(function ($item, $key)
        use ($firstPeriodPlatformsLiquidations, $secondPeriodPlatformsLiquidations) {

            $firstPeriodTotal = $firstPeriodPlatformsLiquidations->has($key) ?
                $firstPeriodPlatformsLiquidations[$key]->sum('accumulated_dollars') / 2 :
                0;

            $secondPeriodTotal = $secondPeriodPlatformsLiquidations->has($key) ?
                $secondPeriodPlatformsLiquidations[$key]->sum('accumulated_dollars') / 2 :
                0;

            $platformName       = $item[0]->cammodelStreamAccount->streaming->streaming;

            return [
                'platform_name'    => $platformName,
                'first_month_usd'  => $firstPeriodTotal,
                'second_month_usd' => $secondPeriodTotal,
                'change_rate'      => $this->toolsInterface->calculateChangeRate($secondPeriodTotal, $firstPeriodTotal)
            ];
        });

        return $platformsLiquidations->sortBy('second_month_usd');
    }

    private function groupByPlatform($incomes)
    {
        return $incomes->groupBy(function ($item) {
            if ($item['cammodelStreamAccount'] != null) {
                if ($item['cammodelStreamAccount']->streaming != null) {
                    return $item['cammodelStreamAccount']->streaming_id;
                }
                return "offline";
            }
            return "offline";
        });
    }

    public function managersList(Request $request)
    {
        $managersIds = $this->employeeInterface->getAllManagersIds()->pluck('id')->all();

        $managersLiquidations = new Collection();

        $fortnightsGap = $this->toolsInterface->getFortnightsGap($request);
        $dates         = $this->toolsInterface->getPastFortnightDates($fortnightsGap);

        foreach ($managersIds as $key => $managerId) {
            $actualFortnightIncomes = $this->cammodelStreamingIncomesInterface->getManagerIncomesByDays($dates, $managerId);
            if ($actualFortnightIncomes->isNotEmpty()) {
                $managersLiquidations[$managerId] = [
                    'manager'         => $actualFortnightIncomes[0]['cammodelWorkReport']['manager'],
                    'manager_incomes' => $actualFortnightIncomes->sum('dollars') / 2,
                ];
            }
        }

        return [
            'data' => [
                'liquidation_period'   => $this->toolsInterface->getPastFortnightDates($fortnightsGap),
                'module'               => $this->module,
                'optionsRoutes'        => config('generals.optionRoutes'),
                'headers'              => ['Manager', 'Acumulado en ventas (USD)', 'Acciones'],
                'managersLiquidations' => $managersLiquidations->sortByDesc('manager_incomes')
            ]
        ];
    }

    public function managerReport(Request $request, int $managerId)
    {
        $fortnightsGap = $this->toolsInterface->getFortnightsGap($request);
        $fortnightsGap += $request['fortnights'];

        $dates = $this->toolsInterface->getPastFortnightDates($fortnightsGap);
        $from  = $dates[0];
        $to    = $dates[1];

        $pastDates = $this->toolsInterface->getPastFortnightDates($fortnightsGap + 1);

        $fixedTo = Carbon::parse($to)->day == 1 ?
            Carbon::parse($to)->subDay()->day :
            Carbon::parse($to)->day;

        $actualFortnightIncomes = $this->cammodelStreamingIncomesInterface->getManagerIncomesByDays($dates, $managerId);
        $prevFortnightIncomes   = $this->cammodelStreamingIncomesInterface->getManagerIncomesByDays($pastDates, $managerId);

        $managersFortnightsIncomes = [
            $actualFortnightIncomes->sum('dollars'),
            $prevFortnightIncomes->sum('dollars')
        ];

        $dailyIncomes = array_fill_keys(range(Carbon::parse($from)->day, $fixedTo), 0);
        $managerDailyIncomes = $actualFortnightIncomes->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('d');
        });

        foreach ($managerDailyIncomes as $key => $cammodelDaysIncome) {
            if (array_key_exists(intval($key), $dailyIncomes)) {
                $dailyIncomes[intval($key)] = $cammodelDaysIncome->sum('dollars');
            }
        }

        $manager = $this->employeeInterface->findEmployeeById($managerId);
        if ($manager->shift_id == null) {
            throw new NoShiftAssignedException('error');
        }
        $managerKpi = $this->kpiInterface->findKpiByShiftAndSubsidiary($manager->subsidiary_id, $manager->shift_id);
        $managerKpi = $managerKpi != null ? $managerKpi->min_fortnight_goal : 1;

        return [
            'data' => [
                'liquidation_period'   => $this->toolsInterface->getPastFortnightDates($fortnightsGap),
                'module'                   => $this->module,
                'optionsRoutes'            => config('generals.optionRoutes'),
                'manager'                  => $manager,
                'managerDailyIncomes'      => $dailyIncomes,
                'managerFortnightsIncomes' => $managersFortnightsIncomes,
                'managerKpi'               => $managerKpi
            ]
        ];
    }

    public function getPeriodIncomes(int $periodType, int $fortnightsGap, array $filtersData)
    {
        if ($periodType == 1) {
            $dates = $this->toolsInterface->getPastFortnightDates($fortnightsGap);
            $from  = $dates[0];
            $actualPeriodDates = [
                Carbon::parse($from)->startOfMonth()->format('Y-m-d') . ' 00:00:00',
                Carbon::parse($from)->endOfMonth()->addDay()->format('Y-m-d') . ' 00:00:00',
            ];
            $prevPeriodDates = [
                Carbon::parse($from)->subMonth()->startOfMonth()->format('Y-m-d') . ' 00:00:00',
                Carbon::parse($from)->subMonth()->endOfMonth()->addDay()->format('Y-m-d') . ' 00:00:00',
            ];
        } else {
            $dates = $this->toolsInterface->getPastFortnightDates($fortnightsGap);
            $from  = $dates[0];
            $prevPeriodDates = [
                Carbon::parse($from)->subMonths(3)->startOfMonth()->format('Y-m-d') . ' 00:00:00',
                Carbon::parse($from)->subMonths(1)->endOfMonth()->addDay()->format('Y-m-d') . ' 00:00:00',
            ];
            $actualPeriodDates = [
                Carbon::parse($from)->startOfMonth()->format('Y-m-d') . ' 00:00:00',
                Carbon::parse($from)->addMonths(2)->endOfMonth()->addDay()->format('Y-m-d') . ' 00:00:00',
            ];
        }

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
        } else {
            $subsidiaryId = $filtersData['subsidiary_id'];
        }

        $actualPeriodIncomes = $this->cammodelStreamingIncomesInterface->getAllPeriodStreamingIncomes($actualPeriodDates, $subsidiaryId, $filtersData['cammodel_id']);
        $prevPeriodIncomes = $this->cammodelStreamingIncomesInterface->getAllPeriodStreamingIncomes($prevPeriodDates, $subsidiaryId, $filtersData['cammodel_id']);

        $managersLiquidations = $this->getManagersLiquidations($actualPeriodIncomes, $prevPeriodIncomes);
        $roomsLiquidations = $this->getRoomsLiquidations($actualPeriodIncomes, $prevPeriodIncomes);
        $shiftsLiquidations = $this->getShiftsLiquidations($actualPeriodIncomes, $prevPeriodIncomes);
        $subsidiaryLiquidations = $this->getSubsidiaryLiquidations($actualPeriodIncomes, $prevPeriodIncomes);

        return [$roomsLiquidations, $managersLiquidations, $shiftsLiquidations, $subsidiaryLiquidations];
    }
}
