<?php

namespace Modules\Companies\Entities\Roles\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CreateRoleErrorException extends \Exception
{
    public $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }

    public function render()
    {
        return response()->redirectToRoute(config('generals.optionRoutes') . '.index')
            ->with('error', config('messaging.creating_error'));
    }
}
