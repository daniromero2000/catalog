<?php

namespace Modules\Companies\Entities\EmployeeEpss\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class EmployeeEpsErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
