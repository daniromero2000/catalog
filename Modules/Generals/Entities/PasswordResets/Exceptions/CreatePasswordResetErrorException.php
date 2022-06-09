<?php

namespace Modules\Generals\Entities\PasswordResets\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CreatePasswordResetErrorException extends \Exception
{
    protected $errors;

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
