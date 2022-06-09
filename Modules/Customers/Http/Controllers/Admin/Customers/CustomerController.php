<?php

namespace Modules\Customers\Http\Controllers\Admin\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces\CivilStatusRepositoryInterface;
use Modules\Generals\Entities\Genres\Repositories\Interfaces\GenreRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Generals\Entities\Relationships\Repositories\Interfaces\RelationshipRepositoryInterface;
use Modules\Generals\Entities\Scholarities\Repositories\Interfaces\ScholarityRepositoryInterface;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Modules\Generals\Entities\VehicleBrands\Repositories\Interfaces\VehicleBrandRepositoryInterface;
use Modules\Generals\Entities\VehicleTypes\Repositories\Interfaces\VehicleTypeRepositoryInterface;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\Customers\Requests\CreateCustomerRequest;
use Modules\Customers\Entities\Customers\Requests\UpdateCustomerRequest;
use Modules\Customers\Entities\Customers\Transformations\CustomerTransformable;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;
use Modules\Customers\Entities\Customers\Requests\UpdateCustomerPasswordRequest;
use Modules\Customers\Entities\Customers\UseCases\Interfaces\CustomerUseCaseInterface;
use Modules\Generals\Entities\EconomicActivityTypes\Repositories\Interfaces\EconomicActivityTypeRepositoryInterface;

class CustomerController extends Controller
{
    use CustomerTransformable;
    private $customerInterface, $customerStatusInterface, $customerStatusesLogInterface;
    private $genreInterface, $cityInterface, $housingInterface;
    private $customerChannelInterface, $stratumInterface, $customerCivilStatusInterface;
    private $customerIdentityTypeInterface, $scholarityInterface;
    private $vehicleTypeInterface, $vehicleBrandInterface, $economicActivityInterface;
    private $professionsListInterface, $relationshipInterface, $epsInterface, $toolsInterface;
    private $customerServiceInterface;

    public function __construct(
        CustomerUseCaseInterface $customerUseCaseInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusRepositoryInterface $customerStatusRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface,
        GenreRepositoryInterface $GenreRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        HousingRepositoryInterface $housingRepositoryInterface,
        CustomerChannelRepositoryInterface $customerChannelRepositoryInterface,
        StratumRepositoryInterface $stratumRepositoryInterface,
        CivilStatusRepositoryInterface $civilStatusRepositoryInterface,
        IdentityTypeRepositoryInterface $identityTypeRepositoryInterface,
        ScholarityRepositoryInterface $scholarityRepositoryInterface,
        VehicleTypeRepositoryInterface $vehicleTypeRepositoryInterface,
        VehicleBrandRepositoryInterface $vehicleBrandRepositoryInterface,
        ProfessionsListRepositoryInterface $professionsListRepositoryInterface,
        RelationshipRepositoryInterface $relationshipRepositoryInterface,
        EpsRepositoryInterface $epsRepositoryInterface,
        EconomicActivityTypeRepositoryInterface $economicActivityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:customers|contract_requests, guard:employee']);
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->customerServiceInterface     = $customerUseCaseInterface;
        $this->customerInterface            = $customerRepositoryInterface;
        $this->customerStatusInterface      = $customerStatusRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->genreInterface               = $GenreRepositoryInterface;
        $this->cityInterface                = $cityRepositoryInterface;
        $this->housingInterface             = $housingRepositoryInterface;
        $this->customerChannelInterface     = $customerChannelRepositoryInterface;
        $this->stratumInterface             = $stratumRepositoryInterface;
        $this->civilStatusInterface         = $civilStatusRepositoryInterface;
        $this->identityTypeInterface        = $identityTypeRepositoryInterface;
        $this->scholarityInterface          = $scholarityRepositoryInterface;
        $this->vehicleTypeInterface         = $vehicleTypeRepositoryInterface;
        $this->vehicleBrandInterface        = $vehicleBrandRepositoryInterface;
        $this->professionsListInterface     = $professionsListRepositoryInterface;
        $this->relationshipInterface        = $relationshipRepositoryInterface;
        $this->epsInterface                 = $epsRepositoryInterface;
        $this->economicActivityInterface    = $economicActivityRepositoryInterface;
        $this->module                       = 'Clientes';
    }

    public function index(Request $request)
    {
        return view('customers::admin.customers.index');
    }

    public function create()
    {
        return view('customers::admin.customers.create', [
            'optionsRoutes'     =>  config('generals.optionRoutes'),
            'module'            => $this->module,
            'genres'            => $this->genreInterface->getAllGenresNames(),
            'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'scholarities'      => $this->scholarityInterface->getAllScholaritiesNames(),
            'civil_statuses'    => $this->civilStatusInterface->getAllCivilStatusesNames(),
            'cities'            => $this->cityInterface->getAllCityNames()
        ]);
    }

    public function store(CreateCustomerRequest $request)
    {
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $customer->id,
            'status'      => 'Creado',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('Admin.customers.show', $customer->id);
    }

    public function show(int $id)
    {
        return view('customers::admin.customers.customer', [
            'customer' => $this->customerInterface->findCustomerById($id)
        ]);
    }

    public function edit($id)
    {
        $customer = $this->customerInterface->findCustomerById($id);

        return view('customers::admin.customers.edit', [
            'customer'            => $customer,
            'customer_channels'   => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'statuses'            => $this->customerStatusInterface->listCustomerStatuses(),
            'scholarities'        => $this->scholarityInterface->getAllScholaritiesNames(),
            'cities'              => $this->cityInterface->getAllCityNames(),
            'currentStatus'       => $customer->customerStatus->id,
            'lead'                => $customer->customerChannel->id,
            'customer_scholarity' => $customer->scholarity->id,
            'customer_city'       => $customer->city->id
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);
        $update   = new CustomerRepository($customer);
        $data     = $request->except('customer_channel', 'customer_status', '_method', '_token', 'password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        unset($customer->age);
        $update->updateCustomer($data);

        $customer = $this->customerInterface->findCustomerById($id);

        $customerStatusLog = array(
            'customer_id' => $customer->id,
            'status'      => 'Actualizado',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $customerStatusLogs = $this->customerStatusesLogInterface->createCustomerStatusesLog($customerStatusLog);
        return response()->json([$update, $customerStatusLogs], 201);
    }

    public function updatePassword(UpdateCustomerPasswordRequest $request, $id)
    {
        $this->customerServiceInterface->updateCustomerPassword($request, $id);
        return back()->with('message', 'Contraseña Asignada Exitosamente');
    }

    public function updateForBlade(UpdateCustomerRequest $request)
    {
        $customer = $this->customerInterface->findCustomerById($request->id);
        $update   = new CustomerRepository($customer);
        $data     = $request->except('customer_channel', 'customer_status', '_method', '_token', 'password', 'id');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        unset($customer->age);
        $update->updateCustomer($data);
        return back()
            ->with('message', 'Actualizado Satisfactoriamente');
    }

    public function destroy($id)
    {
        $customerRepo = new CustomerRepository($this->customerInterface->findCustomerById($id));
        $customerRepo->deleteCustomer();

        return redirect()->route('admin.customers.index')
            ->with('message', 'Eliminado Satisfactoriamente');
    }

    public function getCustomer(int $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);

        return [
            'customer'      => $customer,
            'currentStatus' => $customer->customerStatus
        ];
    }

    public function list(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->customerInterface->searchCustomer(request()->input('q'));
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->customerInterface->listCustomers($skip * 10);
        }

        return [
            'customers'     => $list,
            'headers'       => ['Nombre', 'Apellido', 'Fecha Ingreso', 'Lead', 'Estado', 'Opciones'],
            'optionsRoutes' => 'Admin.' . (request()->segment(2))
        ];
    }

    public function getlistEconomicActivity(Request $request)
    {
        return [
            'professions_lists'       => $this->professionsListInterface->getAllProfessionsNames(),
            'economic_activity_types' => $this->economicActivityInterface->getAllEconomicActivityTypesNames()
        ];
    }

    public function getListCities(Request $request)
    {
        return [
            'cities' => $this->cityInterface->getAllCityNames()
        ];
    }

    public function getRelationships(Request $request)
    {
        return [
            'relationships' => $this->relationshipInterface->getAllRelationshipsNames()
        ];
    }

    public function getCivilStatuses(Request $request)
    {
        return [
            'civil_statuses' => $this->civilStatusInterface->getAllCivilStatusesNames()
        ];
    }

    public function getGenres(Request $request)
    {
        return [
            'genres'  => $this->genreInterface->getAllGenresNames()
        ];
    }

    public function getScholarities(Request $request)
    {
        return [
            'scholarities' => $this->scholarityInterface->getAllScholaritiesNames()
        ];
    }
    public function getProfessions(Request $request)
    {
        return [
            'professions' => $this->professionsListInterface->getAllProfessionsNames()
        ];
    }
    public function getVehicles(Request $request)
    {
        return [
            'vehicle_types'   => $this->vehicleTypeInterface->getAllVehicleTypesNames(),
            'vehicle_brands'  => $this->vehicleBrandInterface->getAllVehicleBrandsNames()
        ];
    }
    public function getIdentityTypes(Request $request)
    {
        return [
            'identity_types'   => $this->identityTypeInterface->getAllIdentityTypesNames()
        ];
    }
    public function getHousings(Request $request)
    {
        return [
            'housings'  => $this->housingInterface->getAllHousingsNames()
        ];
    }
    public function getStratums(Request $request)
    {
        return [
            'stratums' => $this->stratumInterface->getAllStratumsNames()
        ];
    }

    public function getEps(Request $request)
    {
        return [
            'epss'  => $this->epsInterface->getAllEpsNames()
        ];
    }
}
