<?php

namespace Modules\CamStudio\Entities\CammodelStats\UseCases;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelPayrolls\UseCases\Interfaces\CammodelPayrollUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStats\UseCases\Interfaces\CammodelStatUseCaseInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;

class CammodelStatUseCase implements CammodelStatUseCaseInterface
{
    private $toolsInterface, $cammodelPayrollServiceInterface;
    private $streamingStatInterface, $cammodelStreamAccountInterface;
    private $socialStatInterface, $cammodelSocialMediaInterface;
    private $cammodelStreamingIncomesInterface, $cammodelInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        CammodelSocialMediaRepositoryInterface $cammodelSocialMediaRepositoryInterface,
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface,
        CammodelStreamingIncomeRepositoryInterface $cammodelStreamingIncomeRepositoryInterface,
        CammodelPayrollUseCaseInterface $cammodelPayrollServiceInterface,
        SocialStatRepositoryInterface $socialStatRepositoryInterface,
        StreamingStatRepositoryInterface $streamingStatRepositoryInterface
    ) {
        $this->toolsInterface                    = $toolRepositoryInterface;
        $this->cammodelInterface                 = $cammodelRepositoryInterface;
        $this->cammodelStreamAccountInterface    = $cammodelStreamAccountRepositoryInterface;
        $this->cammodelSocialMediaInterface      = $cammodelSocialMediaRepositoryInterface;
        $this->cammodelStreamingIncomesInterface = $cammodelStreamingIncomeRepositoryInterface;
        $this->cammodelPayrollServiceInterface   = $cammodelPayrollServiceInterface;
        $this->socialStatInterface               = $socialStatRepositoryInterface;
        $this->streamingStatInterface            = $streamingStatRepositoryInterface;
        $this->module                            = 'Estadísticas Modelos';
    }

    public function listCammodelStats(): array
    {
        return [
            'liquidation_period'       => $this->toolsInterface->getCammodelStatsPeriodDates(),
            'cammodelStreamingIncomes' => $this->cammodelPayrollServiceInterface->getCammodelsLiquidations(),
            'headers'                  => ['Modelo', 'Acumulado en Ventas (USD)', 'Progreso', 'Opciones'],
            'optionsRoutes'            => config('generals.optionRoutes'),
            'module'                   => $this->module
        ];
    }

    public function showCammodelStats(int $id): array
    {
        $dates = $this->toolsInterface->getCammodelStatsPeriodDates();
        $from  = $dates[0];
        $to    = $dates[1];

        $prevFortnightDates = $this->toolsInterface->getPastFortnightDates(1);

        $infoStreamingStats = $this->cammodelStreamingStats($id, $prevFortnightDates[0], $to);
        $infoSocialStats    = $this->cammodelSocialStats($id, $prevFortnightDates[0], $to);

        $fixedTo = Carbon::parse($to)->day == 1 ?
            Carbon::parse($to)->subDay()->day :
            Carbon::parse($to)->day;

        $dailyIncomes = array_fill_keys(range(Carbon::parse($from)->day, $fixedTo), 0);
        $dailyIncomes = $this->cammodelDailyIncomes($dailyIncomes, $id, $dates);

        $fortnightsIncomes = $this->cammodelPayrollServiceInterface->getCammodelPastLiquidations($id);

        return [
            'cammodel'                 => $this->cammodelInterface->findCammodelById($id),
            'changeRateStreaming'      => $infoStreamingStats[1],
            'cammodelStreamingStats'   => $infoStreamingStats[0],
            'changeRateSocial'         => $infoSocialStats[1],
            'cammodelSocialStats'      => $infoSocialStats[0],
            'dailyIncomes'             => $dailyIncomes,
            'fortnightsIncomes'        => $fortnightsIncomes,
            'cammodelStreamingIncomes' => $this->cammodelPayrollServiceInterface->getCammodelLiquidations($id),
            'optionsRoutes'            => config('generals.optionRoutes'),
            'module'                   => $this->module
        ];
    }

    private function cammodelStreamingStats(int $id, $from, $to): array
    {
        $streamingAccount = $this->cammodelStreamAccountInterface->getCammodelChaturbateAccountId($id)->first();

        $cammodelStreamingStats = new Collection();
        $changeRateStreaming    = 0;
        if ($streamingAccount != null) {
            $cammodelStreamingStats = $this->streamingStatInterface->getCammodelStreamingStats($from, $to, $streamingAccount->id);
            if ($cammodelStreamingStats->isNotEmpty()) {
                if ($cammodelStreamingStats->first()->num_followers != 0 && $cammodelStreamingStats->first()->num_followers != null) {
                    $changeRateStreaming = (($cammodelStreamingStats->last()->num_followers - $cammodelStreamingStats->first()->num_followers)
                        / $cammodelStreamingStats->first()->num_followers) * 100;
                }
            }
        }

        return [$cammodelStreamingStats, $changeRateStreaming];
    }

    private function cammodelSocialStats(int $id, $from, $to): array
    {
        $socialAccount       = $this->cammodelSocialMediaInterface->getCammodelTwitterAccountId($id)->first();
        $cammodelSocialStats = new Collection();
        $changeRateSocial    = 0;
        if ($socialAccount != null) {
            $cammodelSocialStats =  $this->socialStatInterface->getCammodelSocialStats($from, $to, $socialAccount->id);
            if ($cammodelSocialStats->isNotEmpty()) {
                if ($cammodelSocialStats->first()->followers_count != 0 && $cammodelSocialStats->first()->followers_count != null) {
                    $changeRateSocial = (($cammodelSocialStats->last()->followers_count - $cammodelSocialStats->first()->followers_count)
                        / $cammodelSocialStats->first()->followers_count) * 100;
                }
            }
        }

        return [$cammodelSocialStats, $changeRateSocial];
    }

    private function cammodelDailyIncomes(array $dailyIncomes, int $id, $dates)
    {
        $streamAccountsIds = $this->cammodelStreamAccountInterface->findStreamAccountByCammodel($id);

        if ($streamAccountsIds->isNotEmpty()) {
            $streamAccounts      = $streamAccountsIds->pluck('id')->all();
            $cammodelDaysIncomes = $this->cammodelStreamingIncomesInterface->getCammodelIncomesByDays($dates, $streamAccounts);

            if ($cammodelDaysIncomes->isNotEmpty()) {
                $cammodelDaysIncomes = $cammodelDaysIncomes->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('d');
                });

                foreach ($cammodelDaysIncomes as $key => $cammodelDaysIncome) {
                    if (array_key_exists(intval($key), $dailyIncomes)) {
                        $dailyIncomes[intval($key)] = $cammodelDaysIncome->sum('dollars');
                    }
                }
            }
        }

        return $dailyIncomes;
    }
}
