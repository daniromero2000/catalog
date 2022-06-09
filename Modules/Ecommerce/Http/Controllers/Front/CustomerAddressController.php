<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Requests\CreateFrontCustomerAddressRequest;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;

class CustomerAddressController extends Controller
{
    private $addressRepo, $countryRepo, $cityRepo, $provinceRepo, $customerPhoneInterface;

    public function __construct(
        CustomerAddressRepositoryInterface $addressRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        ProvinceRepositoryInterface $provinceRepository,
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface
    ) {
        $this->addressRepo = $addressRepository;
        $this->provinceRepo = $provinceRepository;
        $this->countryRepo = $countryRepository;
        $this->cityRepo = $cityRepository;
        $this->customerPhoneInterface = $customerPhoneRepositoryInterface;
    }

    public function index()
    {
        return redirect()->route('accounts', ['tab' => 'address']);
    }

    public function create()
    {
        return view('ecommerce::front.customers.addresses.create', [
            'customer' => auth()->user(),
            'countries' => $this->countryRepo->getCountriesNames(),
            'cities' => $this->cityRepo->getAllCityNames(),
            'provinces' => $this->provinceRepo->getAllProvincesNames()
        ]);
    }

    public function store(CreateFrontCustomerAddressRequest $request)
    {
        $customerId = auth()->user()->id;
        $addressData = $request->except('_token', '_method', 'phone');
        $addressData['customer_id'] = $customerId;

        $this->addressRepo->createCustomerAddress($addressData);

        $phoneData = $request->except('_token', '_method', 'default_address', 'alias', 'customer_address', 'country_id');
        $phoneData['customer_id'] = $customerId;

        $this->customerPhoneInterface->createCustomerPhone($phoneData);

        return redirect()->route('checkout.index')
            ->with('message', config('messaging.create'));
    }
    public function destroy($id, $addressId)
    {
        $this->addressRepo->deleteCustomerAddress($addressId);
        return back()->with('message', ' Elimnado exitosamente');
        // return redirect()->route('admin.products.index')
        //     ->with('message', config('messaging.delete'));
    }
    public function edit($id)
    {
        //
    }
    public function update($id)
    {
    }
}
