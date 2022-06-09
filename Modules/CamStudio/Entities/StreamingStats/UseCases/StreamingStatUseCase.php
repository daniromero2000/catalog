<?php

namespace Modules\CamStudio\Entities\StreamingStats\UseCases;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\UseCases\Interfaces\StreamingStatUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class StreamingStatUseCase implements StreamingStatUseCaseInterface
{
    private $streamingStatInterface, $toolsInterface;

    public function __construct(
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface,
        StreamingStatRepositoryInterface $streamingStatRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->cammodelStreamAccountsInterface = $cammodelStreamAccountRepositoryInterface;
        $this->streamingStatInterface          = $streamingStatRepositoryInterface;
        $this->toolsInterface                  = $toolRepositoryInterface;
    }

    public function listStreamingStats(Request $request): array
    {
        $actualFortnight = $this->toolsInterface->getPastFortnightDates(0);

        $from = $request->input('from') ?
            Carbon::parse($request->input('from') . " 00:00:01") :
            $actualFortnight[0];

        $to = $request->input('to') ?
            Carbon::parse($request->input('to') . " 23:59:59") :
            now();

        $streaming_platform = $request->input('social_platform') ?
            $request->input('social_platform') : '1';

        $cammodelsStreamingStats = $this->streamingStatInterface
            ->getCammodelsStreamingStats([$from, $to])
            ->groupBy('cammodel_stream_account_id');

        $days = $this->fillDaysArray([$from, $to]);

        return [
            'data' => [
                'cammodels_stats'           => $cammodelsStreamingStats,
                'days'                      => $days,
                'streaming_platform'        => $streaming_platform,
                'module'                    => 'Estadísticas de Streamings',
                'optionsRoutes'             => config('generals.optionRoutes')
            ]
        ];
    }

    private function fillDaysArray(array $dates)
    {
        $from                  = Carbon::parse($dates[0])->subDay();
        $to                    = Carbon::parse($dates[1]);
        $days['days_number']   = $from->copy()->diffInDays($to->copy());
        $days['days']          = [];

        for ($i = 0; $i < $days['days_number']; $i++) {
            array_push($days['days'], $from->addDays(1)->format('m-d'));
        }

        $days['reference_day'] = $to->copy()->dayOfWeek;

        return $days;
    }
}
