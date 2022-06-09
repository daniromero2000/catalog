<?php

namespace Modules\Companies\Http\Controllers\Admin;

use Modules\Companies\Entities\Employees\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use ThrottlesLogins;

    protected $maxAttempts = 2;
    protected $decayMinutes = 1;
    protected $redirectTo = '/admin';

    public function showLoginForm()
    {
        if (auth()->guard('employee')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('generals::auth.admin.login');
    }

    public function login(LoginRequest $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $details = $request->only('email', 'password');
        $details['is_active'] = 1;

        if (auth()->guard('employee')->attempt($details)) {
            $user                = auth()->guard('employee')->user();
            $roles               = $user->role()->get();
            $permission          = [];
            $permissionsRole     = [];
            $permissionsRoleUser = [];
            $actions             = [];
            $actionsUser         = [];
            $actionsPerModule    = [];

            foreach ($roles as $role) {
                $permission = $role->permission->toArray();
                $permissionsRole = $role->permission->whereIn('permission_group_id', config('domain_modules_load.enabled_modules'));
                $actions     = $role->action->toArray();
            }

            foreach ($permissionsRole as $key => $value) {
                $permissionsRoleUser[$permissionsRole[$key]->permissionGroup->name][] = $permissionsRole[$key]->toArray();
            }

            foreach ($permissionsRoleUser as $key => $values) {
                foreach ($permissionsRoleUser[$key] as $key2 => $module) {
                    $actionsUser[$module['id']]      = [];
                    $actionsPerModule[$module['id']] = [];
                    $actionsModule[$module['id']]    = [];
                    foreach ($actions as $action) {
                        if ($module['id'] == $action['permission_id']) {
                            $actionsPerModule[$module['id']][] = $action;
                            $actionsModule[$module['id']][]    = $action['id'];
                            if ($action['principal'] == 1) {
                                $actionsUser[$module['id']][]                      = $action;
                                $permissionsRoleUser[$key][$key2]['actionsPrincipal'][] = $action;
                            } else {
                                $actionsUser[$module['id']][]                      = $action;
                                $permissionsRoleUser[$key][$key2]['actionslist'][] = $action;
                            }
                        }
                    }
                }
            }

            session(['actions'             => $actions]);
            session(['permission'          => $permissionsRoleUser]);
            session(['actionsUser'         => $actionsUser]);
            session(['actionsPerModule'    => $actionsPerModule]);
            session(['actionsModuleOnlyId' => $actionsModule]);

            $user->last_login_at = Carbon::now();
            $user->save();
            $logchannel = config('logging.channels.login.name');

            if (!$logchannel == null) {
                $message = 'Info: Employee:' . $request->getClientIp() . ' User ' . ($user->name) . ' ' . ($user->last_name) .
                    ' has signed in.';
                Log::channel($logchannel)->info($message);
            }

            return redirect()->intended('admin');
            //return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
