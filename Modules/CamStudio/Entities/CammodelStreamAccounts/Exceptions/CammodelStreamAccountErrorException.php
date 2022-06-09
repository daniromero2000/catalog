<?php

namespace Module\CamStudio\Entities\CammodelStreamAccounts\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CammodelStreamAccountErrorMediaException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
