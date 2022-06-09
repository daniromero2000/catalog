<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelSocialMedias;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\CammodelSocialMediaRepository;
use Modules\CamStudio\Entities\CammodelSocialMedias\Repositories\Interfaces\CammodelSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\CammodelSocialMedias\Requests\CreateCammodelSocialMediaRequest;
use Modules\Generals\Entities\SocialMedias\Repositories\Interfaces\SocialMediaRepositoryInterface;
use Modules\Companies\Entities\CorporatePhones\Repositories\Interfaces\CorporatePhonesRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelSocialMediaController extends Controller
{
    private $cammodelSocialMediaInterface, $toolsInterface, $socialmediaInterface;
    private $corporatePhonesInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelSocialMediaRepositoryInterface $cammodelSocialMediaRepositoryInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        SocialMediaRepositoryInterface $socialMediaRepositoryInterface,
        CorporatePhonesRepositoryInterface $corporatePhonesRepositoryInterface
    ) {
        $this->middleware(['permission:cammodel_social|cam_models, guard:employee']);
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->cammodelSocialMediaInterface = $cammodelSocialMediaRepositoryInterface;
        $this->cammodelInterface            = $cammodelRepositoryInterface;
        $this->socialmediaInterface         = $socialMediaRepositoryInterface;
        $this->corporatePhonesInterface     = $corporatePhonesRepositoryInterface;
        $this->module                       = 'Redes sociales modelo';
    }

    public function index(Request $request): View
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->cammodelSocialMediaInterface->searchCammodelSocialMedias(request()->input('q'), $skip * 10);
            $paginate = $this->cammodelSocialMediaInterface->countCammodelSocialMedias(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->cammodelSocialMediaInterface->searchCammodelSocialMedias(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->cammodelSocialMediaInterface->countCammodelSocialMedias(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->cammodelSocialMediaInterface->countCammodelSocialMedias(null);
            $list     = $this->cammodelSocialMediaInterface->listCammodelSocialMedias($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('camstudio::admin.cammodel-social.list', [
            'optionsRoutes'        =>  config('generals.optionRoutes'),
            'module'               => $this->module,
            'cammodelSocialMedias' => $list,
            'skip'                 => $skip,
            'headers'              => ['MODELO', 'RED', 'PERFIL @', 'USUARIO DE ACCESO', 'CONTRASEÑA', 'SIM / TELÉFONO', 'OPCIONES'],
            'skip'                 => $skip,
            'paginate'             => $getPaginate['paginate'],
            'position'             => $getPaginate['position'],
            'page'                 => $getPaginate['page'],
            'limit'                => $getPaginate['limit'],
            'cammodels'            => $this->cammodelInterface->getAllCammodels(),
            'socialmedias'         => $this->socialmediaInterface->getAllSocialMedias(),
            'corporatePhones'      => $this->corporatePhonesInterface->getAllCorporatePhones()
        ]);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-social.create', [
            'optionsRoutes'   => config('generals.optionRoutes'),
            'module'          => $this->module,
            'cammodels'       => $this->cammodelInterface->getAllCammodels(),
            'socialmedias'    => $this->socialmediaInterface->getAllSocialMedias(),
            'corporatePhones' => $this->corporatePhonesInterface->getAllCorporatePhones()
        ]);
    }

    public function store(CreateCammodelSocialMediaRequest $request)
    {
        $this->cammodelSocialMediaInterface->createCammodelSocialMedia($request->except('_token', '_method'));
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $CammodelSocialMediaId)
    {
        return redirect()->route('admin.cammodel-social.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(Request $request, $CammodelSocialMediaId)
    {
        $update = new CammodelSocialMediaRepository($this->cammodelSocialMediaInterface->findCammodelSocialMediaById($CammodelSocialMediaId));
        $update->updateCammodelSocialMedia($request->except('_token', '_method'));
        return redirect()->route('admin.cammodel-social.index')->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->cammodelSocialMediaInterface->findCammodelSocialMediaById($id)->delete();

        return redirect()->route('admin.cammodel-social.index')
            ->with('message', config('messaging.delete'));
    }

    public function verifyPass(Request $request)
    {
        $ids = $this->cammodelSocialMediaInterface->findCammodelSocialMediaById($request->input('passStreaming'));
        if (Hash::check($request->input('verifyPass'), auth()->guard('employee')->user()->password)) {
            return response()->json($ids['password']);
        } else {
            return response()->json('No Correcta');
        }
    }
}
