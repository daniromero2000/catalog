<?php

namespace Modules\CamStudio\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Modules\CamStudio\Entities\BannedCountriesProtectionBanner\BannedCountriesProtectionBanner;

class BannedCountriesProtectionBannerMiddleware
{
    public function handle($request, Closure $next)
    {
        $ses_name = config('bannedcountriesprotectionbanner.ses_name');
        $link     = BannedCountriesProtectionBanner::generate_accept_link($request);

        if ($ses_name == null || !App::environment(config('bannedcountriesprotectionbanner.enabled_environments'))) {
            // Disabled on this environment, or wrong ses_name, or  config:cache production error. Let's just disable
            return $next($request);
        }

        if ($request->input($ses_name) == 'no' || auth()->guard('employee')->check()) {
            // User is from no Banned Country,
            // Log the IP, and explicit accept of conditions
            $this->logAccept($request);

            return $next($request);
        }
        // Show the disclaimer

        return response()->view('layouts.front.country_banner', compact('request'), 406);
    }

    private function logAccept($request)
    {
        $logchannel = config('bannedcountriesprotectionbanner.logchannel');

        if ($logchannel == null) {
            return false;
        }

        $message = 'Info: Client:' . $request->getClientIp() . ' Not Banned Country';
        Log::channel($logchannel)->info($message);
    }

    private function isWhitelisted($request)
    {
        if (config('bannedcountriesprotectionbanner.whitelist') == null) {
            return false;
        }

        $regex = '#' . implode('|', config('bannedcountriesprotectionbanner.whitelist')) . '#';

        return preg_match($regex, $request->path());
    }

    private function IPExcluded($request)
    {
        //return ($this->getContinent($request)!="EU");
        return false;
    }
}
