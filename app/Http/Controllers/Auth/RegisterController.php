<?php

namespace App\Http\Controllers\Auth;

use Modules\Customers\Entities\Customers\Customer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\Customers\Requests\RegisterCustomerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Customers\Entities\CustomerEmails\CustomerEmail;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/accounts';

    private $customerRepo;

    /**
     * Create a new controller instance.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->middleware('guest');
        $this->customerRepo = $customerRepository;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Customer
     */
    protected function create(array $data)
    {
        return $this->customerRepo->createCustomer($data);
    }

    /**
     * @param RegisterCustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterCustomerRequest $request)
    {
        $request['customer_channel_id'] = 10;
        $url = parse_url(redirect()->intended()->getTargetUrl());

        $customer = $this->create($request->except('_method', '_token'));
        $customerEmail = new CustomerEmail();
        $customerEmail->email = $request['email'];
        $customer->customerEmails()->save($customerEmail);

        if ($request['identity_number']) {
            $CustomerIdentity = new CustomerIdentity();
            $CustomerIdentity->identity_number = $request['identity_number'];
            $CustomerIdentity->expedition_date = Carbon::now();
            $CustomerIdentity->city_id = 1;
            $customer->customerIdentities()->save($CustomerIdentity);
        }

        Auth::login($customer);

        if (array_key_exists('path', $url)) {
            return redirect()->route('checkout.index');
        } else {
            return redirect()->route('accounts');
        }
    }
}
