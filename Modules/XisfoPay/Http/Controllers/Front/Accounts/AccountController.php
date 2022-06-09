<?php

namespace Modules\XisfoPay\Http\Controllers\Front\Accounts;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;

class AccountController extends Controller
{

    private $customerRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customer = auth()->user();
        return view('layouts.front.accounts.accounts', [
            'customer'  => $customer,

        ]);
    }
}
