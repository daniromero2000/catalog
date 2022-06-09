<?php

namespace Modules\Customers\Entities\Leads\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class LeadNotFoundException extends \Exception
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
            ->with('error', config('messaging.not_found'));
    }
}
