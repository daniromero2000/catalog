<?php

namespace Modules\Customers\Entities\Customers\Repositories;

use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Modules\Customers\Mail\SendWelcomeToCustomerMailable;
use Modules\Customers\Mail\SendWelcomeEmailNotificationToAdminMailable;
use Illuminate\Support\Facades\Mail;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Exception;
use Modules\Customers\Entities\Cammodels\Exceptions\CustomerNotFoundErrorException;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'birthday',
        'birth_place_id',
        'city_id',
        'scholarity_id',
        'customer_channel_id',
        'civil_status_id',
        'genre_id',
        'customer_status_id',
        'created_at',
        'email'
    ];

    private $columns2 = [
        'id',
        'name',
        'last_name',
        'city_id'
    ];

    private $columns3 = [
        'id',
        'name',
        'last_name',
        'birthday',
        'birth_place_id',
        'city_id',
        'scholarity_id',
        'customer_channel_id',
        'civil_status_id',
        'genre_id',
        'customer_status_id',
        'created_at',
        'email'
    ];

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function listCustomers($totalView): Support
    {
        return  $this->model->with([
            'customerStatus:id,name,color,is_active',
            'customerChannel:id,channel,is_active'
        ])->orderBy('created_at', 'asc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function createCustomer(array $data): Customer
    {
        try {
            $data = collect($data)->except('password')->all();
            $customer = new Customer($data);
            if (isset($data['password'])) {
                $customer->password = bcrypt($data['password']);
            }

            if ($customer->save())
                return $customer;
            else
                throw new Exception("Fallo la creacion del usuario" .  1);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCustomer(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCustomerById(int $id): Customer
    {
        try {
            $customer = $this->model->with([
                'genre',
                'customerPhones',
                'customerAddresses',
                'customerEmails',
                'customerStatus',
                'customerChannel',
                'customerIdentities',
                'city',
                'civilStatus',
                'scholarity',
                'customerCommentaries',
                'customerStatusesLog',
                'customerVehicles',
                'customerProfessions',
                'customerReferences',
                'customerEpss',
                'customerEconomicActivities'
            ])->findOrFail($id, $this->columns);

            $customer->age =  $this->getCustomerAge($customer->birthday);

            return $customer;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCustomerByIdforShipment(int $id): Customer
    {
        try {
            $customer = $this->model->findOrFail($id, $this->columns2);
            return $customer;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findFrontCustomerById(int $id): Customer
    {
        try {
            $customer = $this->model->with([
                'customerPhones',
                'customerAddresses',
                'customerEmails',
                'city',
            ])->findOrFail($id, $this->columns);

            $customer->age =  $this->getCustomerAge($customer->birthday);

            return $customer;
        } catch (ModelNotFoundException $e) {
            throw new CustomerNotFoundErrorException($e->getMessage());
        }
    }

    public function deleteCustomer(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCustomer(string $text = null): Collection
    {
        if (is_null($text)) {
            return  $this->model->with([
                'customerStatus',
                'customerChannel'
            ])->orderBy('created_at', 'asc')
                ->take(10)
                ->get($this->columns);
        }
        return $this->model->searchCustomer($text)->with([
            'customerStatus',
            'customerChannel'
        ])->get($this->columns);
    }

    public function sendEmailToCustomer($customerMail)
    {
        Mail::to($customerMail->email)
            ->send(new SendWelcomeToCustomerMailable($this->model->findCustomerById($customerMail->id)));
    }

    public function sendEmailNotificationToAdmin($customerMail)
    {
        $employeeRepo = new EmployeeRepository(new Employee);
        $employee = $employeeRepo->findEmployeeById(4);
        Mail::to($employee)
            ->send(new sendWelcomeEmailNotificationToAdminMailable($this->model->findCustomerById($customerMail->id)));
    }

    private function getCustomerAge($birthday)
    {
        $now = Carbon::now();
        return $now->diffInYears($birthday);
    }

    public function checkForLogin($email)
    {
        try {
            return $this->model->where('email', $email)
                ->first(['id', 'email', 'password']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findOrders($columns = ['*'], string $orderBy = 'id'): Collection
    {
        return $this->model->orders()->get($columns)->sortByDesc($orderBy);
    }

    /**
     * Find the address attached to the customer
     *
     * @return mixed
     */
    public function findAddresses(): Support
    {
        return $this->model->frontCustomerAddresses;
    }

    public function updateOrCreate($data)
    {
        try {
            return $this->model->updateOrCreate(['email' => $data['email']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }
    public function getAllCustomerNames()
    {
        return $this->model->where('status', 1)->orderBy('id', 'asc')
            ->get(['id', 'name']);
    }

    public function getCustomerByEmail($email)
    {
        return $this->model->where('email', $email)->first($this->columns);
    }
}
