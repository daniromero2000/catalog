<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelStreamAccounts;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Requests\CreateCammodelStreamAccountRequest;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces\CammodelStreamAccountRepositoryInterface;
use Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\CammodelStreamAccountRepository;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\Companies\Entities\CorporatePhones\Repositories\Interfaces\CorporatePhonesRepositoryInterface;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelStreamAccountsController extends Controller
{
    private $cammodelStreamAccountInterface, $toolsInterface, $corporatePhonesInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        CammodelStreamAccountRepositoryInterface $cammodelStreamAccountRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface,
        CorporatePhonesRepositoryInterface $corporatePhonesRepositoryInterface
    ) {
        $this->middleware(['permission:cammodel_streamings|cam_models, guard:employee']);
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->cammodelInterface              = $cammodelRepositoryInterface;
        $this->streamingInterface             = $streamingRepositoryInterface;
        $this->cammodelStreamAccountInterface = $cammodelStreamAccountRepositoryInterface;
        $this->corporatePhonesInterface       = $corporatePhonesRepositoryInterface;
        $this->module                         = 'Cuentas Streaming de modelos';
    }

    public function index(Request $request): View
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();
        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->cammodelStreamAccountInterface->searchCammodelStreamAccounts(request()->input('q'), $skip * 10);
            $paginate = $this->cammodelStreamAccountInterface->countCammodelStreamAccounts(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->cammodelStreamAccountInterface->searchCammodelStreamAccounts(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->cammodelStreamAccountInterface->countCammodelStreamAccounts(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->cammodelStreamAccountInterface->countCammodelStreamAccounts(null);
            $list     = $this->cammodelStreamAccountInterface->listCammodelStreamAccounts($skip * 10);
        }

        $deactivate_array = [];
        $cammodel_to_deactivate = [];
        foreach ($list as $streamAccount) {
            if ($streamAccount->cammodel == null) {
                array_push($cammodel_to_deactivate, $streamAccount->cammodel_id);
                array_push($deactivate_array, $streamAccount->id);
            }
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('camstudio::admin.cammodel-streamings.list', [
            'optionsRoutes'          => config('generals.optionRoutes'),
            'module'                 => $this->module,
            'cammodelStreamAccounts' => $list,
            'skip'                   => $skip,
            'optionsRoutes'          => config('generals.optionRoutes'),
            'headers'                => ['Modelo', 'Perfil @', 'Usuario', 'Plataforma', 'Contraseña', 'Telefóno', 'Simcard', 'Opciones'],
            'skip'                   => $skip,
            'paginate'               => $getPaginate['paginate'],
            'position'               => $getPaginate['position'],
            'page'                   => $getPaginate['page'],
            'limit'                  => $getPaginate['limit'],
            'cammodels'              => $this->cammodelInterface->getAllCammodels(),
            'streamings'             => $this->streamingInterface->getAllStreamingNames(),
            'streamings'             => $this->streamingInterface->getAllStreamingNames(),
            'corporatePhones'        => $this->corporatePhonesInterface->getAllCorporatePhones()
        ]);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-streamings.create', [
            'optionsRoutes'   => config('generals.optionRoutes'),
            'module'          => $this->module,
            'cammodels'       => $this->cammodelInterface->getAllCammodels(),
            'streamings'      => $this->streamingInterface->getAllStreamingNames(),
            'corporatePhones' => $this->corporatePhonesInterface->getAllCorporatePhones()
        ]);
    }

    public function store(CreateCammodelStreamAccountRequest $request)
    {
        $this->cammodelStreamAccountInterface->createCammodelStreamAccount($request->except('_token', '_method'));
        return back()->with('message', config('messaging.create'));
    }

    public function show($CammodelStreamAccountId)
    {
        return redirect()->route('admin.cammodel-streamings.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(Request $request, int $CammodelStreamAccountId)
    {
        $update = new CammodelStreamAccountRepository($this->cammodelStreamAccountInterface->findCammodelStreamAccountById($CammodelStreamAccountId));
        $update->updateCammodelStreamAccount($request->except('_token', '_method'));
        return redirect()->route('admin.cammodel-streamings.index')->with('message', config('messaging.update'));
    }

    public function destroy($CammodelStreamAccountId)
    {
        $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($CammodelStreamAccountId)->delete();

        return redirect()->route('admin.cammodel-streamings.index')
            ->with('message', config('messaging.delete'));
    }

    public function verifyPass(Request $request)
    {
        $ids = $this->cammodelStreamAccountInterface->findCammodelStreamAccountById($request->input('passStreaming'));
        if (Hash::check($request->input('verifyPass'), auth()->guard('employee')->user()->password)) {
            return response()->json($ids['password']);
        } else {
            return response()->json('No Correcta');
        }
    }
}
