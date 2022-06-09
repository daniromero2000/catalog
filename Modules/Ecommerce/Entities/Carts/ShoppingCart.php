<?php

namespace Modules\Ecommerce\Entities\Carts;

use Modules\Ecommerce\Entities\Shoppingcart\Cart;
use Modules\Ecommerce\Entities\Shoppingcart\CartItem;

class ShoppingCart extends Cart
{
    public static $defaultCurrency;
    protected $session, $event;

    public function __construct()
    {
        $this->session = $this->getSession();
        $this->event = $this->getEvents();
        parent::__construct($this->session, $this->event);
        self::$defaultCurrency = config('cart.currency');
    }

    public function getSession()
    {
        return app()->make('session');
    }

    public function getEvents()
    {
        return app()->make('events');
    }

    /**
     * Get the total price of the items in the cart.
     *
     * @param int $decimals
     * @param string $decimalPoint
     * @param string $thousandSeparator
     * @param float $shipping
     * @return string
     */
    public function total($decimals = null, $decimalPoint = null, $thousandSeparator = null, $shipping = 0.0)
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, CartItem $cartItem) {

            return $total + ($cartItem->qty * $cartItem->priceTax);
        },);

        $grandTotal = $total + $shipping;

        return number_format($grandTotal, $decimals, $decimalPoint, $thousandSeparator);
    }
}
