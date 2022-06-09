<?php

namespace Modules\Ecommerce\Entities\Products\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class ProductInvalidArgumentException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
