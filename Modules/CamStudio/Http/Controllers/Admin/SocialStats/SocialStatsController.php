<?php

namespace Modules\CamStudio\Http\Controllers\Admin\SocialStats;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;

class SocialStatsController extends Controller
{
    private $socialStatInterface, $cammodelSocialMediaInterface;

    public function __construct(
        SocialStatRepositoryInterface $socialStatRepositoryInterface,
        CammodelSocialMediaRepositoryInterface $cammodelSocialMediaRepositoryInterface
    ) {
        $this->middleware(['permission:cammodel_social, guard:employee']);
        $this->socialStatInterface          = $socialStatRepositoryInterface;
        $this->cammodelSocialMediaInterface = $cammodelSocialMediaRepositoryInterface;
    }

    public function index(Request $request): View
    {
        $from                   = $request->input('from') ? Carbon::parse($request->input('from') . " 00:00:01") : Carbon::now()->subWeek()->format('Y-m-d') . " 00:00:01";
        $to                     = $request->input('to') ? Carbon::parse($request->input('to') . " 23:59:59") : Carbon::now();
        $social_platform        = $request->input('social_platform') ? $request->input('social_platform') : '3';
        $social_platform_models = $this->cammodelSocialMediaInterface->getCammodelsSocialMedia($social_platform);
        $cammodels              = $this->socialStatInterface->getCammodelsIds($social_platform_models, $from, $to);
        $stats                  = $this->socialStatInterface->findAllSocialStats($from, $to);
        $models_stats           = new Collection();

        foreach ($cammodels as $key => $cammodel) {
            $models_stats[$key] = new Collection;
            $stats->each(function ($item) use ($cammodel, $models_stats, $key) {
                if ($item->cammodel_social_media_id == $cammodel) {
                    $models_stats[$key]->push($item);
                }
            });
        }

        switch ($social_platform) {
            case '2':
                $social_platform = 'Instagram';
                break;
            case '3':
                $social_platform = 'Twitter';
                break;
        }

        $list                  = $this->socialStatInterface->searchSocialStat(request()->input('q'), $cammodels, $from, $to);
        $from                  = Carbon::parse($from)->subDay();
        $to                    = Carbon::parse($to);
        $days['days_number']   = $from->diffInDays($to);
        $days['days']          = [];

        for ($i = 0; $i < $days['days_number']; $i++) {
            array_push($days['days'], $from->addDays(1)->format('m-d'));
        }

        $days['reference_day'] = $to->dayOfWeek;

        return view('camstudio::admin.social-stats.list', [
            'cammodels_stats' => $models_stats,
            'days'            => $days,
            'models_stats'    => $list,
            'social_platform' => $social_platform,
            'module'          => 'Estadísticas Redes Sociales',
            'optionsRoutes'   => config('generals.optionRoutes')
        ]);
    }

    public function show(int $id)
    {
        return redirect()->route('admin.social-stats.index')
            ->with('error', config('messaging.not_found'));
    }
}
