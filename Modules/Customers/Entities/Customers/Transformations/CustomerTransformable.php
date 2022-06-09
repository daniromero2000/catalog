<?php

namespace Modules\Customers\Entities\Customers\Transformations;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Support\Carbon;

trait CustomerTransformable
{
    protected function transformCustomer(Customer $customer)
    {
        $prop             = new Customer;
        $prop->id         = (int) $customer->id;
        $prop->name       = $customer->name;
        $prop->last_name  = $customer->last_name;
        $prop->channel_id = $customer->customerChannel;
        $prop->created_at =  $customer->created_at;
        $prop->status     = (int) $customer->status;
        $prop->status_id  = $customer->customerStatus;
        return $prop;
    }
}
