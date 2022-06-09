<?php

namespace Modules\Customers\Entities\CustomerAddresses\Transformations;


use Modules\Ecommerce\Entities\Cities\Repositories\CityRepository;


use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Generals\Entities\Countries\Country;
use Modules\Generals\Entities\Countries\Repositories\CountryRepository;
use Modules\Generals\Entities\Provinces\Province;
use Modules\Generals\Entities\Provinces\Repositories\ProvinceRepository;

trait AddressTransformable
{

    public function transformAddress(CustomerAddress $address)
    {
        $obj = new CustomerAddress;
        $obj->id = $address->id;
        $obj->address_1 = $address->address_1;
        $obj->address_2 = $address->address_2;
        $obj->zip = $address->zip;
        $obj->city = $address->city;

        if (isset($address->province_id)) {
            $provinceRepo = new ProvinceRepository(new Province());
            $province = $provinceRepo->findProvinceById($address->province_id);
            $obj->province = $province->name;
        }

        $countryRepo = new CountryRepository(new Country());
        $country = $countryRepo->findCountryById($address->country_id);
        $obj->country = $country->name;

        $customerRepo = new CustomerRepository(new Customer());
        $customer = $customerRepo->findCustomerById($address->customer_id);
        $obj->customer = $customer->name;
        $obj->status = $address->status;

        return $obj;
    }
}