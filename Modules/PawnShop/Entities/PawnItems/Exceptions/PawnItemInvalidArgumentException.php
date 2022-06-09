<?php

namespace Modules\PawnShop\Entities\PawnItems\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class PawnItemInvalidArgumentException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
