<?php

namespace Modules\Ecommerce\Entities\Checkout\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Checkout\Checkout;
use Modules\Ecommerce\Entities\Orders\Exceptions\OrderNotFoundException;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\Checkout\Repositories\Interfaces\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    protected $model;
    protected $columns = ['id', 'customer_id', 'created_at'];

    public function __construct(Checkout $checkout)
    {
        $this->model = $checkout;
    }

    public function updateOrCreateCheckout($data)
    {
        try {
            $checkout = $this->model->updateOrCreate(
                ['customer_id' => $data['customer_id']],
                [$data]
            );
        } catch (QueryException $e) {
            dd($e);
        }

        $checkoutRepo = new CheckoutRepository($checkout);
        $checkoutRepo->buildCheckoutDetails(Cart::content());
        return true;
    }

    public function listCheckouts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->with('products')
            ->get($this->columns);
    }

    public function findCheckoutById(int $id): Checkout
    {
        try {
            return $this->model->with(['products', 'customer'])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e->getMessage());
        }
    }

    public function associateProduct(Product $product, int $quantity = 1, array $data = [])
    {
        try {
            $this->model->products()->attach($product, [
                'quantity' => $quantity,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'product_price' => $product->price,
                'product_attribute_id' => isset($data['product_attribute_id']) ? $data['product_attribute_id'] : null,
            ]);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLastCheckout(): Checkout
    {
        return  $this->model->get()->last();
    }

    public function removeCheckout($checkout): bool
    {
        try {
            $this->model->products()->detach();
            return $this->model->where('id', $checkout->id)->forceDelete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function buildCheckoutDetails(Collection $items)
    {
        $items->each(function ($item) {
            $productRepo = new ProductRepository(new Product);
            $product = $productRepo->find($item->id);
            if ($item->options->has('product_attribute_id')) {
                $this->associateProduct($product, $item->qty, [
                    'product_attribute_id' => $item->options->product_attribute_id
                ]);
            } else {
                $this->associateProduct($product, $item->qty);
            }
        });
    }

    public function buildCheckoutItems(array $data): Order
    {
        $orderRepo = new OrderRepository(new Order);
        $order = $orderRepo->createOrder([
            'reference' => $data['reference'],
            'courier_id' => $data['courier_id'],
            'customer_id' => $data['customer_id'],
            'address_id' => $data['address_id'],
            'order_status_id' => $data['order_status_id'],
            'payment' => $data['payment'],
            'discounts' => $data['discounts'],
            'sub_total' => $data['sub_total'],
            'grand_total' => $data['grand_total'],
            'total_paid' => $data['total_paid'],
            'total_shipping' => isset($data['total_shipping']) ? $data['total_shipping'] : 0,
            'tax_amount' => $data['tax']
        ]);

        return $order;
    }

    public function buildPayUCheckoutItems(array $data): Order
    {
        $orderRepo = new OrderRepository(new Order);
        $order = $orderRepo->createPayUOrder([
            'reference' => $data['reference'],
            'courier_id' => $data['courier_id'],
            'customer_id' => $data['customer_id'],
            'address_id' => $data['address_id'],
            'order_status_id' => $data['order_status_id'],
            'payment' => $data['payment'],
            'discounts' => $data['discounts'],
            'sub_total' => $data['sub_total'],
            'grand_total' => $data['grand_total'],
            'total_paid' => $data['total_paid'],
            'total_shipping' => isset($data['total_shipping']) ? $data['total_shipping'] : 0,
            'tax_amount' => $data['tax']
        ]);

        return $order;
    }

    public function getCreditCards($array)
    {
        $cards = [];
        $temp = [];
        foreach ($array as $key => $value) {
            if ($value->description == 'VISA' || $value->description == 'MASTERCARD' || $value->description == 'DINERS') {
                if (!in_array($value->description, $temp)) {
                    $temp[] = $value->description;
                    if ($value->description == 'VISA') {
                        $value->icon = 'img/cards/visa.png';
                    }
                    if ($value->description == 'MASTERCARD') {
                        $value->icon = 'img/cards/mastercard.png';
                    }
                    if ($value->description == 'DINERS') {
                        $value->icon = 'img/cards/diners.png';
                    }
                    array_push($cards, $value);
                }
            }
        }

        return $cards;
    }

    public function getBalotoEfecty($array)
    {
        $getBalotoEfecty = [];
        foreach ($array as $key => $value) {
            if ($value->description == 'BALOTO' || $value->description == 'EFECTY') {
                if ($value->description == 'BALOTO') {
                    $value->icon = 'img/cards/baloto.png';
                }
                if ($value->description == 'EFECTY') {
                    $value->icon = 'img/cards/efecty.png';
                }
                array_push($getBalotoEfecty, $value);
            }
        }
        return $getBalotoEfecty;
    }

    public function getPse($array)
    {
        foreach ($array as $key => $value) {
            if (($value->description) == 'PSE') {
                $array = $value;
            }
        }
        return $array;
    }

    public function searchCheckouts(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->list($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchCheckouts($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCheckouts($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countCheckouts(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCheckouts($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchCheckouts($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function list(int $totalView): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }
}
