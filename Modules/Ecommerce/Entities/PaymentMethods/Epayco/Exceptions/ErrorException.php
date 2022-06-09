<?php

namespace Modules\Ecommerce\Entities\PaymentMethods\Epayco\Exceptions;

use Modules\Ecommerce\Entities\PaymentMethods\Epayco\EpaycoException;

class ErrorException extends EpaycoException
{
    public function __toString()
    {
        $errors = json_decode(file_get_contents(EpaycoException::ERRORS_URL), true);
        return __CLASS__ . ": {$errors[(string)$this->code][$this->message]}\n";
    }
}
