<?php

namespace Modules\Customers\Entities\Customers\UseCases\Interfaces;

interface CustomerUseCaseInterface
{
    public function updateCustomerPassword($request, int $id);
}
