<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeIdentityErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
