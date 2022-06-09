<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelStats;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelStats\UseCases\Interfaces\CammodelStatUseCaseInterface;

class CammodelStatsController extends Controller
{
    private $cammodelStatServiceInterface;

    public function __construct(
        CammodelStatUseCaseInterface $cammodelStatUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_stats, guard:employee']);
        $this->cammodelStatServiceInterface    = $cammodelStatUseCaseInterface;
    }

    public function index(): View
    {
        return view(
            'camstudio::admin.cammodel-stats.list',
            $this->cammodelStatServiceInterface->listCammodelStats()
        );
    }

    public function show(int $cammodelId): View
    {
        return view(
            'camstudio::admin.cammodel-stats.show',
            $this->cammodelStatServiceInterface->showCammodelStats($cammodelId)
        );
    }
}
