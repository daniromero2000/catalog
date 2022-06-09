<?php

namespace Module\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CammodelTipperSocialMediaException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}
