<?php

namespace Modules\XisfoPay\Http\Middleware\Front;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Modules\XisfoPay\Entities\Contracts\Exceptions\ContractNotFoundException;
use Modules\XisfoPay\Entities\Contracts\Repositories\Interfaces\ContractRepositoryInterface;

class ContractUserIsOwner
{
    private $contractsInterface;

    public function __construct(
        Guard $auth,
        ContractRepositoryInterface $contractRepositoryInterface
    ) {
        $this->auth = $auth;
        $this->contractsInterface = $contractRepositoryInterface;
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
            $contract = $this->contractsInterface->findContractById(intval($request->segments()[2]));
        } catch (ContractNotFoundException $e) {
            return redirect()->route('account.dashboard')
                ->with('error', config('messaging.not_found'));
        }

        if ($contract->ContractRequests[0]->customer->id !== $this->auth->user()->id) {
            return back();
        }

        return $next($request);
    }
}
