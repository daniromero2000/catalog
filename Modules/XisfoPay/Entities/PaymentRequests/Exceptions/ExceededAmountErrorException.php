<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class ExceededAmountErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
