<?php

namespace Modules\Companies\Http\Controllers\Admin\Companies;

use Modules\Companies\Entities\Companies\Repositories\CompanyRepository;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Companies\Entities\Companies\Requests\CreateCompanyRequest;
use Modules\Companies\Entities\Companies\Requests\UpdateCompanyRequest;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $toolsInterface, $companyInterface, $countryInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CompanyRepositoryInterface $companyRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface
    ) {
        $this->toolsInterface   = $toolRepositoryInterface;
        $this->companyInterface = $companyRepositoryInterface;
        $this->countryInterface = $countryRepositoryInterface;
        $this->module           = 'Compañias';
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->companyInterface->searchCompany(request()->input('q'));
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->companyInterface->listCompanies($skip * 10);
        }

        return view('companies::admin.companies.list', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'companies'     => $list,
            'skip'          => $skip,
            'countries'     => $this->countryInterface->getAllCountriesNames(),
            'headers'       => ['NOMBRE DE EMPRESA', 'NIT / IDENTIFIACIÓN', 'TIPO DE COMPAÑÍA', 'ESTADO', 'OPCIONES']
        ]);
    }

    public function create()
    {
        return view('companies::admin.companies.create', [
            'countries'     => $this->countryInterface->getAllCountriesNames(),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCompanyRequest $request)
    {
        $this->companyInterface->createCompany($request->except('_token', '_method'));

        return redirect()->route('admin.companies.index')
            ->with('message', 'Compañia Creada Exitosamente!');
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.companies.index');
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $update = new CompanyRepository($this->companyInterface->findCompanyById($id));
        $update->updateCompany($request->except('_token', '_method'));

        return redirect()->route('admin.companies.index')->with('message', 'Actualizacion Exitosa');
    }

    public function show(int $id)
    {
        return redirect()->route('admin.companies.index')
            ->with('error', config('messaging.not_found'));
    }

    public function destroy(int $id)
    {
        $company = new CompanyRepository($this->companyInterface->findCompanyById($id));
        $company->deleteCompany();

        return redirect()->route('admin.companies.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
