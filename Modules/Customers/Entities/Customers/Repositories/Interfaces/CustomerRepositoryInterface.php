<?php

namespace Modules\Customers\Entities\Customers\Repositories\Interfaces;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Collection;


interface CustomerRepositoryInterface
{
    public function listCustomers($totalView);

    public function createCustomer(array $data): Customer;

    public function updateCustomer(array $data): bool;

    public function findCustomerById(int $id): Customer;

    public function findFrontCustomerById(int $id): Customer;

    public function deleteCustomer(): bool;

    public function searchCustomer(string $text = null): Collection;

    public function sendEmailToCustomer($customer);

    public function sendEmailNotificationToAdmin($customer);

    public function checkForLogin($email);

    public function findOrders($columns = ['*'], string $orderBy = 'id'): Collection;

    public function findCustomerByIdforShipment(int $id): Customer;

    public function updateOrCreate($data);

    public function getAllCustomerNames();

    public function getCustomerByEmail($email);
}
