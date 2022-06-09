<?php

namespace Modules\Generals\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Generals\Entities\IpsAccess\IpsAccess;

class IpsAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $ses_name = config('ipsaccess.ses_name');
        $link     = IpsAccess::checkIpAccess($request);

        if ($ses_name == null || !App::environment(config('ipsaccess.enabled_environments'))) {
            // Disabled on this environment, or wrong ses_name, or  config:cache production error. Let's just disable
            $request->request->remove($ses_name);
            return $next($request);
        }

        if ($request->input($ses_name) == 'no') {
            $request->request->remove($ses_name);

            return $next($request);
        }
        // Show the disclaimer

        return redirect()->route('/');
    }
}
