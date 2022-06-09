<?php

namespace Modules\Companies\Entities\EmployeeProfessions\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeProfessionErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
