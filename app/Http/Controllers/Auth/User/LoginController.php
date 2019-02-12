<?php

namespace App\Http\Controllers\Auth\User;

use App\User;
use Illuminate\Http\Request;
use App\Session as LoginSession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$field => $login]);

        return $field;
    }


    public function showLoginForm()
    {
        return view('auth.user.login');
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        $user = $this->getUserFromRequest($request) ?? null;

        if ($user && $user->blocked) {
            return $this->sendFailedLoginResponse($request, null, null, true);
        }

        // User exists but already logged in
        // By default, if user info is invalid, consider it as it's already logged in
        // Hence prevent login process
        $isLoggedIn = is_null($this->validateOtherDevicesLogin($user)) ? true : $this->validateOtherDevicesLogin($user);
        // $customMsg = $isLoggedIn ? 'True' : null;
        $owner = $user ? $user->serial : null;

        if (!$isLoggedIn && $this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request, $isLoggedIn, $owner);
    }


    protected function getUserFromRequest(Request $request)
    {
        $username = $this->username();

        return User::where($username, $request->$username)->first();
    }


    protected function sendFailedLoginResponse(Request $request, $customMessage = null, $owner = null, $blocked = null)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            "customMessage" => $customMessage,
            "errorOwner" => $owner,
            "blocked" => $blocked
        ]);
    }


    public function validateOtherDevicesLogin($user)
    {
        if (is_null($user) || !$user) {
            return null;
        }

        return LoginSession::otherDevicesLoggedIn($user->id);
    }


    public function logoutAllDevices(Request $request)
    {
        if ($request->ajax()) {
            $owner_serial = $request->owner ?? null;
            if ($owner_serial) {
                $user = User::where('serial', $owner_serial)->first();
                if ($user) {
                    $user->invalidateAllLogginSessions();
                    //LoginSession::deleteByUserID($user->id);
                    return response()->json('All devices logged out', 200);
                }
            }
        }

        return response()->json('Invalid Data provided', 303);
    }
}