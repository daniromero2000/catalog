<?php

namespace Modules\Companies\Entities\EmployeePhones\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeePhoneErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
