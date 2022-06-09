<?php

namespace Modules\Ecommerce\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Modules\Companies\Entities\Employees\Requests\CartLoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;

class CartLoginController extends Controller
{

    private $customerInterface;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/checkout';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->customerInterface = $customerRepositoryInterface;
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('layouts.front.auth.login_customer');
    }

    /**
     * Login the customer
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(CartLoginRequest $request)
    {
        $user = $this->customerInterface->checkForLogin($request['email']);

        if ($user) {
            Auth::login($user);
            return redirect()->intended('checkout');
        } else {
            session(['email' => $request['email']]);
            return redirect('register');
        }
    }
}
