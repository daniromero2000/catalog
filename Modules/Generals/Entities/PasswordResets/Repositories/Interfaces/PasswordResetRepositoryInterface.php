<?php

namespace Modules\Generals\Entities\PasswordResets\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\PasswordResets\PasswordReset;

interface PasswordResetRepositoryInterface
{
    public function createPasswordReset(array $request): PasswordReset;

    public function getResetLink($request, $customer);

    public function getEmailByToken($token);

    public function deleteResetPassword($email): bool;
}
