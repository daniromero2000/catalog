<?php

namespace Modules\Companies\Http\Controllers\Admin\CorporatePhones;

use Modules\Companies\Entities\CorporatePhones\Repositories\CorporatePhonesRepository;
use Modules\Companies\Entities\CorporatePhones\Repositories\Interfaces\CorporatePhonesRepositoryInterface;
use Modules\Companies\Entities\CorporatePhones\Requests\CreateCorporatePhonesRequest;
use Modules\Companies\Entities\CorporatePhones\Requests\UpdateCorporatePhonesRequest;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CorporatePhonesController extends Controller
{
    private $toolsInterface, $corporatePhoneInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CorporatePhonesRepositoryInterface $corporatePhoneRepositoryInterface
    ) {
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->corporatePhoneInterface = $corporatePhoneRepositoryInterface;
        $this->module                  = 'Números Corporativos';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->corporatePhoneInterface->searchCorporatePhones(request()->input('q'), $skip * 10);
            $paginate = $this->corporatePhoneInterface->countCorporatePhones(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->corporatePhoneInterface->searchCorporatePhones(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->corporatePhoneInterface->countCorporatePhones(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->corporatePhoneInterface->countCorporatePhones(null);
            $list     = $this->corporatePhoneInterface->listCorporatePhones($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('companies::admin.corporate-phones.list', [
            'corporatePhones' => $list,
            'optionsRoutes'   =>  config('generals.optionRoutes'),
            'module'          => $this->module,
            'headers'         => ['ID', 'Número Simcard', 'Operador', 'Número', 'Opciones'],
            'skip'            => $skip,
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('companies::admin.corporate-phones.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCorporatePhonesRequest $request)
    {
        $this->corporatePhoneInterface->createCorporatePhone($request->except('_token', '_method'));

        return redirect()->route('admin.corporate-phones.index')
            ->with('message', 'Teléfono Corporativo Creado Exitosamente!');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.corporate-phones.index')
            ->with('error', config('messaging.not_found'));
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.corporate-phones.index');
    }

    public function update(UpdateCorporatePhonesRequest $request, $id)
    {
        $update = new CorporatePhonesRepository($this->corporatePhoneInterface->findCorporatePhoneById($id));
        $update->updateCorporatePhone($request->except('_token', '_method'));

        return redirect()->route('admin.corporate-phones.index')->with('message', 'Actualizacion Exitosa');
    }

    public function destroy(int $id)
    {
        $corporatePhone = new CorporatePhonesRepository($this->corporatePhoneInterface->findCorporatePhoneById($id));
        $corporatePhone->deleteCorporatePhone();

        return redirect()->route('admin.corporate-phones.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
