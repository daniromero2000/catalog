<?php

namespace Modules\Ecommerce\Entities\Orders\Repositories;

use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Ecommerce\Mail\SendEmailNotificationToAdminMailable;
use Modules\Ecommerce\Mail\SendOrderToCustomerMailable;
use Modules\Ecommerce\Entities\Orders\Exceptions\OrderInvalidArgumentException;
use Modules\Ecommerce\Entities\Orders\Exceptions\OrderNotFoundException;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Transformers\OrderTransformable;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class OrderRepository implements OrderRepositoryInterface
{
    use OrderTransformable;
    protected $model;
    private $columns = [
        'id',
        'reference',
        'courier_id',
        'customer_id',
        'address_id',
        'order_status_id',
        'payment',
        'discounts',
        'total_shipping',
        'sub_total',
        'tax_amount',
        'grand_total',
        'created_at',
        'total_paid'
    ];

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function createOrder(array $data): Order
    {
        try {
            $order = $this->model->create($data);
            $orderRepo = new OrderRepository($order);
            $orderRepo->buildOrderDetails(Cart::content());

            return $order;
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function createPayUOrder(array $data): Order
    {
        try {
            return  $this->model->create($data);
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function updateOrder(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage());
        }
    }

    public function findOrderById(int $id): Order
    {
        try {
            return $this->model->with(['orderPayments', 'orderShipment', 'orderProducts'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e->getMessage());
        }
    }

    public function findOrderByReference($reference): Order
    {
        try {
            return $this->model->with(['orderPayments', 'orderShipment'])
                ->where('reference', $reference)
                ->first($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e->getMessage());
        }
    }

    public function findOrderByCustomerId($id): Order
    {
        try {
            return $this->model->with(['orderPayments', 'orderShipment'])
                ->where('customer_id', $id)
                ->orderBy('created_at', 'desc')
                ->first($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e->getMessage());
        }
    }

    public function listOrders(int $totalView): Collection
    {
        return $this->model->with(['orderStatus', 'companyId'])
            ->orderBy('id', 'desc')
            ->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function findProducts(Order $order): Collection
    {
        return $order->products;
    }

    public function associateProduct(Product $product, int $quantity = 1, array $data = [])
    {
        if (isset($data['product_attribute_id'])) {
            $attribute = $product->attributes->where('id', $data['product_attribute_id'])->first();
            $product->attributes->where('id', $data['product_attribute_id'])->first();
            $attribute->quantity = $attribute->quantity - $quantity;
            $attribute->save();
            if ($attribute->sale_price) {
                $product_order_price = $attribute->sale_price;
            } else {
                $product_order_price = $attribute->price;
            }
        } else {
            $product_order_price = $product->price;
        }

        $this->model->products()->attach($product, [
            'quantity' => $quantity,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'product_description' => $product->description,
            'product_price' =>  $product_order_price,
            'product_attribute_id' => isset($data['product_attribute_id']) ? $data['product_attribute_id'] : null
        ]);

        $product->quantity = ($product->quantity - $quantity);
        $product->save();
    }

    public function sendEmailToCustomer()
    {
        Mail::to($this->model->customer)
            ->send(new SendOrderToCustomerMailable($this->model));
    }

    public function sendEmailNotificationToAdmin()
    {
        $employeeRepo = new EmployeeRepository(new Employee);
        $employee = $employeeRepo->findEmployeeById(4);

        Mail::to($employee)
            ->send(new SendEmailNotificationToAdminMailable($this->findOrderById($this->model->id)));
    }

    public function sendEmailNotificationToComercial()
    {
        Mail::to(['email' => 'fvnventas@gmail.com'])
            ->send(new SendEmailNotificationToAdminMailable($this->findOrderById($this->model->id)));
    }

    public function searchOrder(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listOrders($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchOrder($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchOrder($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countOrder(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchOrder($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchOrder($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function transform()
    {
        return $this->transformOrder($this->model);
    }

    public function listOrderedProducts(): Collection
    {
        return $this->model->orderProducts->map(function (Product $product) {
            $product->name = $product->pivot->product_name;
            $product->sku = $product->pivot->product_sku;
            $product->description = $product->pivot->product_description;
            $product->price = $product->pivot->product_price;
            $product->quantity = $product->pivot->quantity;
            $product->weight = $product->weight;
            $product->product_attribute_id = $product->pivot->product_attribute_id;
            return $product;
        });
    }

    public function buildOrderDetails(Collection $items)
    {
        $items->each(function ($item) {
            $productRepo = new ProductRepository(new Product);
            $product = $productRepo->find($item->id);
            if ($item->options->has('product_attribute_id')) {
                $this->associateProduct($product, $item->qty, [
                    'product_attribute_id' => $item->options->product_attribute_id,
                ]);
            } else {
                $this->associateProduct($product, $item->qty);
            }
        });
    }

    public function getAddresses(): Collection
    {
        return $this->model->address()->get();
    }

    public function getCouriers(): Collection
    {
        return $this->model->courier()->get();
    }

    public function removeOrder(): bool
    {
        try {
            return $this->model->where('id', $this->model->id)->delete();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findOrderShippings($id): Collection
    {
        try {
            return $this->model->with(['order_id'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e->getMessage());
        }
    }
}
