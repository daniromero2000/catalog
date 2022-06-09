<?php

namespace Modules\Generals\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AgeProtectionBannerMiddleware
{
    private function isReddit(Request $request)
    {
        return strpos($request->header('User-Agent'), 'redditbot') !== false;
    }

    public function handle($request, Closure $next)
    {
        $ses_name = config('ageprotectionbanner.ses_name');

        if ($ses_name == null || !App::environment(config('ageprotectionbanner.enabled_environments'))) {
            // Disabled on this environment, or wrong ses_name, or  config:cache production error. Let's just disable
            return $next($request);
        }

        if ($request->cookie($ses_name) || $this->IPExcluded($request) || $this->isWhitelisted($request) || $this->isReddit($request)) {
            // Already confirmed
            return $next($request);
        } elseif ($request->input($ses_name) == 'yes') {
            // User is confirming the conditions,

            if ($request->input('id')) {
                // If this user comes from a referal, save it on the session
                Session::put('saved_adult_affiliate_id', $request->input('id'));
            }

            // Log the IP, and explicit accept of conditions
            $this->logAccept($request);

            $newurl = $request->url();

            if ($request->input('utm_source') || $request->input('utm_medium') || $request->input('utm_campaign' || $request->input('utm_medium'))) {
                $newurl .= '';

                $extra_items = [];

                if ($request->input('utm_source')) {
                    array_push($extra_items, 'utm_source=' . $request->input('utm_source'));
                }

                if ($request->input('utm_medium')) {
                    array_push($extra_items, 'utm_medium=' . $request->input('utm_medium'));
                }

                if ($request->input('utm_campaign')) {
                    array_push($extra_items, 'utm_campaign=' . $request->input('utm_campaign'));
                }

                if ($request->input('s')) {
                    array_push($extra_items, 's=' . $request->input('s'));
                }

                $newurl .= '?' . implode($extra_items, ['&']);
            }

            $redirect = Redirect::away($newurl);
            $redirect->withCookie(cookie($ses_name, 'yes', 259200));
            $redirect->header('Location', $newurl);

            $redirect->setTargetUrl($newurl);

            return $redirect;
        }

        return response()->view('layouts.front.adult_banner', compact('request'), 406);
    }

    private function logAccept($request)
    {
        $logchannel = config('ageprotectionbanner.logchannel');

        if ($logchannel == null) {
            return false;
        }

        $message = 'Info: Client:' . $request->getClientIp() . ' clicked YES. I`m an adult ';
        Log::channel($logchannel)->info($message);
    }

    private function isWhitelisted($request)
    {
        if (config('ageprotectionbanner.whitelist') == null) {
            return false;
        }

        $regex = '#' . implode('|', config('ageprotectionbanner.whitelist')) . '#';

        return preg_match($regex, $request->path());
    }

    private function IPExcluded($request)
    {
        //return ($this->getContinent($request)!="EU");
        return false;
    }

    private function getContinent(Request $request)
    {
        $ip = $request->getClientIp();

        return 'DISABLED';
        //        return GeoIP::getLocation($request->getClientIp())['continent'];
    }
}
