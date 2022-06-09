<?php

namespace Modules\Companies\Entities\Employees\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class NoShiftAssignedException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
