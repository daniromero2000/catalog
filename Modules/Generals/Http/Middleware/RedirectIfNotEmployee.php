<?php

namespace Modules\Generals\Http\Middleware;

use Closure;

class RedirectIfNotEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'employee')
    {
        if (!auth()->guard($guard)->check()) {
            app('redirect')->setIntendedUrl($request->url());
            $request->session()->flash('error', 'Debes ser un empleado para ver esta página');
            return redirect(route('admin.loginform'));
        }

        return $next($request);
    }
}
