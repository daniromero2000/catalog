<?php

namespace Module\Companies\Entities\CorporatePhones\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CorporatePhoneErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
