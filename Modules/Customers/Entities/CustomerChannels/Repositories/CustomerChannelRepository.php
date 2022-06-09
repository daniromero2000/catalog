<?php

namespace Modules\Customers\Entities\CustomerChannels\Repositories;

use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;

class CustomerChannelRepository implements CustomerChannelRepositoryInterface
{
    protected $model;

    public function __construct(
        CustomerChannel $customerChannel
    ) {
        $this->model = $customerChannel;
    }

    public function getAllCustomerChannelNames()
    {
        return $this->model->get(['id', 'channel']);
    }
}
