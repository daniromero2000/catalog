<?php

namespace Modules\XisfoPay\Http\Middleware\Front;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\PaymentRequestNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;

class PaymentRequestUserIsOwner
{
    private $paymentRequestsInterface;

    public function __construct(
        Guard $auth,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface
    ) {
        $this->auth = $auth;
        $this->paymentRequestsInterface = $paymentRequestRepositoryInterface;
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
            $payment = $this->paymentRequestsInterface->findPaymentRequestById(intval($request->segments()[2]));
        } catch (PaymentRequestNotFoundException $e) {
            return redirect()->route('account.dashboard')
                ->with('error', config('messaging.not_found'));
        }

        if ($payment->contractRequestStreamAccount->contractRequest->customer->id !== $this->auth->user()->id) {
            return back();
        }

        return $next($request);
    }
}
