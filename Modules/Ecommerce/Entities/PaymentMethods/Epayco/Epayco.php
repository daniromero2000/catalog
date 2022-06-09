<?php

namespace Modules\Ecommerce\Entities\PaymentMethods\Epayco;

use ErrorException;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Bank;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Cash;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Charge;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Customers;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Plan;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Subscriptions;
use Modules\Ecommerce\Entities\PaymentMethods\Epayco\Resources\Token;

/**
 * Global class constructor
 */
class Epayco
{
    /**
     * Public key client
     * @var String
     */
    public $api_key;
    /**
     * Private key client
     * @var String
     */
    public $private_key;

    /**
     * test mode transaction
     * @var String
     */
    public $test;

    /**
     * lang client errors
     * @var String
     */
    public $lang;

    /**
     * Constructor methods publics
     * @param array $options
     */
    public function __construct($options)
    {
        $this->api_key     = $options["apiKey"];
        $this->private_key = $options["privateKey"];
        $this->test        = $options["test"] ? "TRUE" : "FALSE";
        $this->lang        = $options["lenguage"];
        if (!$this->api_key && !$this->private_key && $this->test && $this->lang) {
            throw new ErrorException($this->lang, 100);
        }

        $this->token = new Token($this);
        $this->customer = new Customers($this);
        $this->plan = new Plan($this);
        $this->subscriptions = new Subscriptions($this);
        $this->bank = new Bank($this);
        $this->cash = new Cash($this);
        $this->charge = new Charge($this);

    }
}
