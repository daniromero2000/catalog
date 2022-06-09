<?php

namespace Modules\Generals\Entities\PasswordResets\Repositories;

use Illuminate\Database\QueryException;
use Modules\Generals\Entities\PasswordResets\Exceptions\DeletingPasswordResetErrorException;
use Modules\Generals\Entities\PasswordResets\Exceptions\PasswordResetInvalidArgumentException;
use Modules\Generals\Entities\PasswordResets\PasswordReset;
use Modules\Generals\Entities\PasswordResets\Repositories\Interfaces\PasswordResetRepositoryInterface;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    protected $model;
    private $columns = ['email', 'token', 'created_at', 'updated_at'];

    public function __construct(PasswordReset $passwordReset)
    {
        $this->model = $passwordReset;
    }

    public function createPasswordReset(array $request): PasswordReset
    {
        try {
            return $this->model->create($request);
        } catch (QueryException $e) {
            throw new PasswordResetInvalidArgumentException($e->getMessage());
        }
    }

    public function getResetLink($request, $customer)
    {
        return config('app.url') . 'password/reset/' . $request['token'] . '?email=' . urlencode($customer->email);
    }

    public function getEmailByToken($token)
    {
        return $this->model->where('token', $token)
            ->first(['email']);
    }

    public function deleteResetPassword($email): bool
    {
        try {
            return $this->model->where('email', $email->email)->delete();
        } catch (QueryException $e) {
            throw new DeletingPasswordResetErrorException($e->getMessage());
        }
    }
}
