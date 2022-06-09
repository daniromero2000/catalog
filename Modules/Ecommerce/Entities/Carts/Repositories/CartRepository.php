<?php

namespace Modules\Ecommerce\Entities\Carts\Repositories;

use Modules\Ecommerce\Entities\Carts\Exceptions\ProductInCartNotFoundException;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Carts\ShoppingCart;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Shoppingcart\Cart;
use Modules\Ecommerce\Entities\Shoppingcart\CartItem;
use Modules\Ecommerce\Entities\Shoppingcart\Exceptions\InvalidRowIDException;
use Illuminate\Support\Collection;

class CartRepository implements CartRepositoryInterface
{
    public function __construct(ShoppingCart $cart)
    {
        $this->model = $cart;
    }

    public function addToCart(Product $product, int $int, $options = []): CartItem
    {
        return $this->model->add($product, $int, $options);
    }

    public function getCartItems(): Collection
    {
        return $this->model->content();
    }

    public function removeToCart(string $rowId)
    {
        try {
            $this->model->remove($rowId);
        } catch (InvalidRowIDException $e) {
            throw new ProductInCartNotFoundException('Product in cart not found.');
        }
    }

    public function countItems(): int
    {
        return $this->model->count();
    }

    public function getSubTotal(int $decimals = 2)
    {
        return $this->model->subtotal($decimals, '.', '');
    }

    public function getTotal(int $decimals = 2, $shipping = 0.00)
    {
        return $this->model->total($decimals, '.', '', $shipping);
    }

    public function updateQuantityInCart(string $rowId, int $quantity): CartItem
    {
        return $this->model->update($rowId, $quantity);
    }

    public function findItem(string $rowId): CartItem
    {
        return $this->model->get($rowId);
    }

    public function getTax(int $decimals = 2)
    {
        return $this->model->tax($decimals);
    }

    public function getShippingFee(Courier $courier)
    {
        return $courier->cost;
    }

    public function clearCart()
    {
        $this->model->destroy();
    }

    public function saveCart(Customer $customer, $instance = 'default')
    {
        $this->model->instance($instance)->store($customer->email);
    }

    public function openCart(Customer $customer, $instance = 'default')
    {
        $this->model->instance($instance)->restore($customer->email);
        return $this->model;
    }

    public function getCartItemsTransformed(): Collection
    {
        return $this->getCartItems()->map(function ($item) {
            $productRepo = new ProductRepository(new Product());
            $product = $productRepo->findProductById($item->id);
            $item->product = $product;
            $item->cover = $product->cover;
            $item->description = $product->description;
            return $item;
        });
    }
}
