<?php

namespace Modules\Ecommerce\Entities\PaymentMethods;

use Modules\Ecommerce\Entities\PaymentMethods\PayU\Contracts\PayuClientInterface;

class Payment
{
    protected $payment;

    public function __construct($class)
    {
        $this->payment = $class;
    }

    public function init()
    {
        return $this->payment;
    }

    public function doPing(PayuClientInterface $payuClient)
    {
        $payuClient->doPing(function ($response) {
            $code = $response->code;
            dd($code);
        }, function ($error) {
            dd($error);
        });
    }
}
