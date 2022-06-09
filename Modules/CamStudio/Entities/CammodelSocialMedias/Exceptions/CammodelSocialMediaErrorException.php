<?php

namespace Module\CamStudio\Entities\CammodelSocialMedias\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CammodelSocialMediaException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
