<?php

namespace Modules\Customers\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerAddresses\Requests\CreateCustomerAddressRequest;
use Modules\Customers\Entities\CustomerAddresses\Requests\UpdateCustomerAddressRequest;
use Modules\Customers\Entities\CustomerAddresses\Repositories\CustomerAddressRepository;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;

class CustomerAddressController extends Controller
{
    private $addressRepo, $countryRepo, $cityRepo, $provinceRepo;

    public function __construct(
        CustomerAddressRepository $addressRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
        ProvinceRepositoryInterface $provinceRepository
    ) {
        $this->middleware(['permission:customers, guard:customer']);
        $this->addressRepo  = $addressRepository;
        $this->countryRepo  = $countryRepository;
        $this->provinceRepo = $provinceRepository;
        $this->cityRepo     = $cityRepository;
        $this->module       = 'Direcciones Clientes';
    }

    public function index()
    {
        $customer = auth()->user();

        return view('front.customers.addresses.list', [
            'customer'  => $customer,
            'addresses' => $customer->addresses
        ]);
    }

    public function create()
    {
        return view('front.customers.addresses.create', [
            'customer'      => auth()->user(),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module,
            'countries'     => $this->countryRepo->getCountriesNames(),
            'cities'        => $this->cityRepo->getAllCityNames(),
            'provinces'     => $this->provinceRepo->getAllProvincesNames()
        ]);
    }

    public function store(CreateCustomerAddressRequest $request)
    {
        $request['customer_id'] = auth()->user()->id;
        $this->addressRepo->createCustomerAddress($request->except('_token', '_method'));

        return redirect()->route('accounts', ['tab' => 'profile'])
            ->with('message', 'Address creation successful');
    }

    public function edit($addressId, $customerId)
    {
        $address   = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

        return view('front.customers.addresses.edit', [
            'customer'  => auth()->user(),
            'address'   => $address,
            'countries' => $this->countryRepo->getCountriesNames(),
            'cities'    => $this->cityRepo->getAllCityNames(),
            'provinces' => $this->provinceRepo->getAllProvincesNames()
        ]);
    }

    public function update(UpdateCustomerAddressRequest $request, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());
        $request = $request->except('_token', '_method');
        $request['customer_id'] = auth()->user()->id;
        $addressRepo = new CustomerAddressRepository($address);
        $addressRepo->updateCustomerAddress($request);

        return redirect()->route('accounts', ['tab' => 'profile'])
            ->with('message', 'Address update successful');
    }

    public function destroy($addressId, $customerId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());
        $address->delete();

        return redirect()->route('accounts',  ['tab' => 'profile'])
            ->with('message', 'Contacto eliminado satisfactoriamente');
    }
}
