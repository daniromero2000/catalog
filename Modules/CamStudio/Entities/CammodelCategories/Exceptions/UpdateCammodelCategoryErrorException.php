<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class UpdateCammodelCategoryErrorException extends \Exception
{
    public $errors;

    public function __construct($e)
    {
        $this->errors       = $e;
        ToolRepository::logException($this->errors);
    }

    public function render()
    {
        return response()->redirectToRoute(config('generals.optionRoutes') . '.index')
            ->with('error', config('messaging.updating_error'));
    }
}
