<?php

namespace Modules\XisfoPay\Http\Middleware\Front;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\PaymentRequestAdvanceNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;

class PaymentRequestAdvanceUserIsOwner
{
    private $paymentRequestAdvancesInterface;

    public function __construct(
        Guard $auth,
        PaymentRequestAdvanceRepositoryInterface $paymentRequestAdvanceRepositoryInterface
    ) {
        $this->auth = $auth;
        $this->paymentRequestAdvancesInterface = $paymentRequestAdvanceRepositoryInterface;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $paymentAdvance = $this->paymentRequestAdvancesInterface->findPaymentRequestAdvanceById(intval($request->segments()[2]));
        } catch (PaymentRequestAdvanceNotFoundException $e) {
            return redirect()->route('account.dashboard')
                ->with('error', config('messaging.not_found'));
        }

        if ($paymentAdvance->paymentRequest->contractRequestStreamAccount->contractRequest->customer->id !== $this->auth->user()->id) {
            return back();
        }

        return $next($request);
    }
}
