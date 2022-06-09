<?php

namespace Modules\Ecommerce\Entities\Carts\Repositories\Interfaces;


use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Shoppingcart\CartItem;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function addToCart(Product $product, int $int, $options = []): CartItem;

    public function getCartItems(): Collection;

    public function removeToCart(string $rowId);

    public function countItems(): int;

    public function getSubTotal(int $decimals = 2);

    public function getTotal(int $decimals = 2, $shipping = 0.00);

    public function updateQuantityInCart(string $rowId, int $quantity): CartItem;

    public function findItem(string $rowId): CartItem;

    public function getTax(int $decimals = 2);

    public function getShippingFee(Courier $courier);

    public function clearCart();

    public function saveCart(Customer $customer, $instance = 'default');

    public function openCart(Customer $customer, $instance = 'default');

    public function getCartItemsTransformed(): Collection;
}
