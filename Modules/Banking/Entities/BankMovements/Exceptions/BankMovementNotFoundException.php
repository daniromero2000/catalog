<?php

namespace Modules\Banking\Entities\BankMovements\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class BankMovementNotFoundException extends \Exception
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
            ->with('error', config('messaging.not_found'));
    }
}
