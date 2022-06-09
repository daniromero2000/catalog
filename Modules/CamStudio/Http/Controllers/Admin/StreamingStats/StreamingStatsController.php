<?php

namespace Modules\CamStudio\Http\Controllers\Admin\StreamingStats;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\StreamingStats\UseCases\Interfaces\StreamingStatUseCaseInterface;

class StreamingStatsController extends Controller
{
    private $streamingStatServiceInterface;

    public function __construct(
        StreamingStatUseCaseInterface $streamingStatUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_streamings, guard:employee']);
        $this->streamingStatServiceInterface   = $streamingStatUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->streamingStatServiceInterface->listStreamingStats($request);

        return view('camstudio::admin.streaming-stats.list', $response['data']);
    }
}
