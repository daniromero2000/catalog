<?php

namespace Modules\Customers\Http\Controllers\Front\Customers;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\Customers\Requests\CreateCustomerRequest;
use Modules\Customers\Entities\Customers\Requests\UpdateCustomerFrontRequest;
use Modules\Customers\Entities\Customers\Transformations\CustomerTransformable;
use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerStatuses\Repositories\CustomerStatusRepository;

class CustomerController extends Controller
{
    use CustomerTransformable;
    private $customerRepoInterface, $customerStatusRepoInterface;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusRepositoryInterface $customerStatusRepositoryInterface
    ) {
        $this->middleware(['permission:customers, guard:customer']);
        $this->customerRepoInterface       = $customerRepositoryInterface;
        $this->customerStatusRepoInterface = $customerStatusRepositoryInterface;
    }

    public function index()
    {
        if (request()->has('q')) {
            $list = $this->customerRepoInterface->searchCustomer(request()->input('q'));
        } else {
            $list = $this->customerRepoInterface->listCustomers('created_at', 'desc');
        }

        $customers = $list->map(function (Customer $customer) {
            return $this->transformCustomer($customer);
        })->all();

        return view('customers::admin.customers.list', [
            'customers' => $this->customerRepoInterface->paginateArrayResults($customers)
        ]);
    }

    public function create()
    {
        return view('customers::admin.customers.create', [
            'statuses' => $this->customerStatusRepo->listCustomerStatuses ()
        ]);
    }

    public function store(CreateCustomerRequest $request)
    {
        $this->customerRepoInterface->createCustomer($request->except('_token', '_method'));

        return redirect()->route('admin.customers.index');
    }

    public function show(int $id)
    {
        $customer = $this->customerRepoInterface->findCustomerById($id);
        return view('customers::admin.customers.show', [
            'user'          => auth()->guard('employee')->user(),
            'customer'      => $this->customerRepoInterface->findCustomerById($id),
            'addresses'     => $customer->addresses,
            'commentaries'  => $customer->commentaries,
            'items'         => $customer->items,
            'currentStatus' => $this->customerStatusRepo->findCustomerStatusById($customer->customer_status_id)
        ]);
    }

    public function edit($id)
    {
        return view('front.customers.edit', [
            'customer' => $this->customerRepoInterface->findCustomerById($id)
        ]);
    }

    public function update(UpdateCustomerFrontRequest $request, $id)
    {
    }

    public function updatePassword(UpdateCustomerRequest $request, $id)
    {
        $customer = $this->customerRepo->findCustomerById($id);

        $update = new CustomerRepository($customer);
        $data = $request->except('_method', '_token', 'password');

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $update->updateCustomer($data);

        $request->session()->flash('message', 'Asignación de clave exitosa');
        return redirect()->route('compraventaOnline');
    }

    public function destroy($id)
    {
        $customer = $this->customerRepo->findCustomerById($id);
        $customerRepo = new CustomerRepository($customer);
        $customerRepo->deleteCustomer();
        return redirect()->route('admin.customers.index')->with('message', 'Eliminado Satisfactoriamente');
    }

    private function transFormOrder(Collection $list)
    {
        $customerStatusRepo = new CustomerStatusRepository(new CustomerStatus());

        return $list->transform(function (Order $customer) use ($customerStatusRepo) {
            $customer->status = $customerStatusRepo->findCustomerStatusById($customer->order_status_id);
            return $customer;
        })->all();
    }
}
