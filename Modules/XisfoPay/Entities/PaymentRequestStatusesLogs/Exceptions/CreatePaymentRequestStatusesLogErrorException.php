<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;

class CreatePaymentRequestStatusesLogErrorException extends \Exception
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
