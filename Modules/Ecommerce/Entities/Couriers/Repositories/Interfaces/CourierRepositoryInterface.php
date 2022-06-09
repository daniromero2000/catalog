<?php

namespace Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Couriers\Courier;
use Illuminate\Support\Collection;

interface CourierRepositoryInterface
{
    public function createCourier(array $data): Courier;

    public function updateCourier(array $data): bool;

    public function findCourierById(int $id): Courier;

    public function findCourierByProvince(int $province_id);

    public function listCouriers(string $order = 'id', string $sort = 'desc'): Collection;

    public function deleteCourier();

    public function getCourier();
}
