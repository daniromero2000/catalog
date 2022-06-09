<?php

namespace Modules\Companies\Http\Controllers\Admin\Subsidiaries;

use Modules\Companies\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Requests\CreateSubsidiaryRequest;
use Modules\Companies\Entities\Subsidiaries\Requests\UpdateSubsidiaryRequest;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;

class SubsidiaryController extends Controller
{
    private $subsidiaryInterface, $cityInterface, $toolsInterface;

    public function __construct(
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:subsidiaries, guard:employee']);
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->cityInterface       = $cityRepositoryInterface;
        $this->module              = 'Sucursal';
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->subsidiaryInterface->searchSubsidiary(request()->input('q'));
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list =  $this->subsidiaryInterface->listSubsidiaries($skip * 10);
        }

        return view('companies::admin.subsidiaries.list', [
            'subsidiaries'  => $list,
            'skip'          => $skip,
            'cities'        => $this->cityInterface->getAllCityNames(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['ID', 'Sucursal', 'Dirección', 'Teléfono', 'Ciudad', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('companies::admin.subsidiaries.create', [
            'cities'        => $this->cityInterface->getAllCityNames(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateSubsidiaryRequest $request)
    {
        $request['company_id'] = 1;
        $this->subsidiaryInterface->createSubsidiary($request->except('_token', '_method'));

        return redirect()->route('admin.subsidiaries.index')
            ->with('message', 'Sucursal Creada Exitosamente!');
    }

    public function show(int $subsidiaryId)
    {
        $subsidiary = $this->subsidiaryInterface->findSubsidiaryById($subsidiaryId);

        return view('companies::admin.subsidiaries.show', [
            'subsidiary'   => $subsidiary,
            'subsidiaries' => $subsidiary->children
        ]);
    }

    public function edit(int $subsidiaryId)
    {
        $subsidiary = $this->subsidiaryInterface->findSubsidiaryById($subsidiaryId);

        return view('companies::admin.subsidiaries.edit', [
            'subsidiary' => $subsidiary,
            'cities'     => $this->cityInterface->getAllCityNames(),
            'cityId'     => $subsidiary->city_id
        ]);
    }

    public function update(UpdateSubsidiaryRequest $request, int $subsidiaryId)
    {
        $update = new SubsidiaryRepository($this->subsidiaryInterface->findSubsidiaryById($subsidiaryId));
        $update->updateSubsidiary($request->except('_token', '_method'));

        return redirect()->route('admin.subsidiaries.index')->with('message', 'Actualizacion Exitosa');
    }


    public function destroy(int $subsidiaryId)
    {
        $subsidiary = new SubsidiaryRepository($this->subsidiaryInterface->findSubsidiaryById($subsidiaryId));
        $subsidiary->deleteSubsidiary();

        return redirect()->route('admin.subsidiaries.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
