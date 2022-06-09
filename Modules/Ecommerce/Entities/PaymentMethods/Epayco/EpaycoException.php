<?php

namespace Modules\Ecommerce\Entities\PaymentMethods\Epayco;


class EpaycoException extends \Exception
{  protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
    const ERRORS_URL = "https://s3-us-west-2.amazonaws.com/epayco/message_api/errors.json";
}
