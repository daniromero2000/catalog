<?php

namespace Modules\XisfoPay\Http\Middleware\Front;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\ContractRequestNotFoundException;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;

class ContractRequestUserIsOwner
{
    private $contractRequestsInterface, $contractRequest;

    public function __construct(
        Guard $auth,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface
    ) {
        $this->auth = $auth;
        $this->contractRequestsInterface = $contractRequestRepositoryInterface;
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
        if (array_key_exists(2, $request->segments())) {
            try {
                $this->contractRequest = $this->contractRequestsInterface->findContractRequestById(intval($request->segments()[2]));
            } catch (ContractRequestNotFoundException $e) {
                return redirect()->route('account.dashboard')
                    ->with('error', config('messaging.not_found'));
            }
        } else {
            return redirect()->route('account.dashboard')
                ->with('error', config('messaging.not_found'));
        }

        if ($this->contractRequest->customer_id !== $this->auth->user()->id) {
            return back();
        }

        return $next($request);
    }
}
