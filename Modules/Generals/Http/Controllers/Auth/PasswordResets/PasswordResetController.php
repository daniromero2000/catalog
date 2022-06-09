<?php

namespace Modules\Generals\Http\Controllers\Auth\PasswordResets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as ServerRequest;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Generals\Entities\PasswordResets\Repositories\Interfaces\PasswordResetRepositoryInterface;

class PasswordResetController extends Controller
{
    private $passwordResetInterface, $customerInterface;

    public function __construct(
        PasswordResetRepositoryInterface $passwordResetRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->passwordResetInterface   = $passwordResetRepositoryInterface;
        $this->customerInterface        = $customerRepositoryInterface;
    }

    public function resetPassword()
    {
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
    }

    public function update()
    {
        //
    }
    public function destroy($id)
    {
        //
    }

    public function showResetForm($request)
    {
        return view('layouts.auth.password-reset', [
            'token' => $request
        ]);
    }

    public function passwordReset(ServerRequest $request)
    {
        $email = $this->passwordResetInterface->getEmailByToken($request->token);

        if (!$email) {
            return view('layouts.auth.email-not-found');
        }

        $customer           = $this->customerInterface->getCustomerByEmail($email->email);
        $customer->password = \Hash::make($request->password);
        $customer->save();
        $this->passwordResetInterface->deleteResetPassword($email);

        return view('xisfopay::auth.login')->with('message', 'Tu contraseña se ha asignado');
    }
}
