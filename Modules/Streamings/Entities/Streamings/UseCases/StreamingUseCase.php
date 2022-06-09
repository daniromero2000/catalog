<?php

namespace Modules\Streamings\Entities\Streamings\UseCases;

use Illuminate\Http\Request;
use Modules\Streamings\Entities\Streamings\Repositories\StreamingRepository;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Streaming;

class StreamingUseCase implements StreamingUseCaseInterface
{
    private $streamingRepositoryInterface, $toolsInterface, $module;

    public function __construct(
        StreamingRepositoryInterface $streamingRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface
    ) {
        $this->streamingRepositoryInterface = $streamingRepositoryInterface;
        $this->countryInterface             = $countryRepositoryInterface;
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->module                       = 'Streamings';
    }

    public function listStreamings(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'streamings'    => $this->streamingRepositoryInterface->searchStreaming($searchData['q']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Nombre', 'URL', 'Comisión USD', 'Equivalente USD', 'Estado', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createStreaming(): array
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeStreaming(array $requestData): void
    {
        $this->streamingRepositoryInterface->createStreaming($requestData);
    }

    public function updateStreaming($request, int $streamingId): Void
    {
        $streaming           = $this->getStreaming($streamingId);
        $requestData         = $request->except('_token', '_method');
        $requestData['icon'] = $this->saveStreamingFile($request, $streaming);
        $update              = new StreamingRepository($streaming);
        $update->updateStreaming($requestData);
    }

    public function destroyStreaming(int $streamingId): Void
    {
        $this->getStreamingRepository($streamingId)->deleteStreaming();
    }

    public function saveStreamingFile(Request $request, Streaming $streaming)
    {
        if ($request->hasFile('icon')) {
            if ($streaming->icon != 'No icon' && $streaming->icon != null) {
                $this->toolsInterface->deleteThumbFromServer($streaming->icon);
            }
            return $this->streamingRepositoryInterface->saveStreamingIcon($request->file('icon'), $streaming->streaming);
        }
    }

    private function getStreamingRepository(int $streamingId): StreamingRepository
    {
        return new StreamingRepository($this->getStreaming($streamingId));
    }

    private function getStreaming(int $streamingId): Streaming
    {
        return $this->streamingRepositoryInterface->findStreamingById($streamingId);
    }

    public function dollarCalculator($tokens, $usdTokenRate)
    {
        return round(floatval($usdTokenRate) * floatval($tokens), 2);
    }

    public function streamingsCommissions($chaseTransfer)
    {
        $costs = 0;
        $streamings = $chaseTransfer->chaseTransferAmounts->groupBy('streaming_id');

        foreach ($streamings as $streaming) {
            $costs += $streaming[0]->streaming->usd_commission;
        }

        if ($streamings->has(17)) {
            $epayCommission = $streamings[17]->sum('amount') * ($streamings[17][0]->streaming->usd_token_rate);
            $costs += $epayCommission;
        }

        return $costs;
    }
}
