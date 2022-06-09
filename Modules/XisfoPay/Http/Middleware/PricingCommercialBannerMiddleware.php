<?php

namespace Modules\XisfoPay\Http\Middleware;

use Closure;
use Modules\Companies\Entities\EmployeeIdentities\Exceptions\EmployeeIdentityNotFoundException;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\EmployeeIdentityRepository;

class PricingCommercialBannerMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->input('employee_identity')) {

            $validated = $request->validate([
                'employee_identity' => ['string', 'between:5,30', 'regex:/^[0-9]+$/u']
            ]);

            try {
                if (EmployeeIdentityRepository::staticCheckIfExists($request)) {
                    return $next($request);
                }
            } catch (EmployeeIdentityNotFoundException $th) {
                return back()->with('error', 'Acceso denegado');
            }
        }

        return response()->view('xisfopay::front.pricing.pricing_commercial_banner', compact('request'), 406);
    }
}
