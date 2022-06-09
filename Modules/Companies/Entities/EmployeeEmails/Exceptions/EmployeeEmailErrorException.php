<?php

namespace Modules\Companies\Entities\EmployeeEmails\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeEmailErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
