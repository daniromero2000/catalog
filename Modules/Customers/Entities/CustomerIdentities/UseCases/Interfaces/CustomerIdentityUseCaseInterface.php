<?php

namespace Modules\Customers\Entities\CustomerIdentities\UseCases\Interfaces;

use Modules\Customers\Entities\CustomerIdentities\Requests\UpdateCustomerIdentityRequest;

interface CustomerIdentityUseCaseInterface
{
    public function storeCustomerIdentity($request);

    public function createCustomerIdentity();

    public function updateCustomerIdentity($request, int $id);

    public function storeFrontCustomerIdentity($request);

    public function updateFrontCustomerIdentity($request, int $id);

}
