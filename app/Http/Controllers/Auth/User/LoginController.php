<?php

namespace App\Http\Controllers\Auth\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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
    /* public function username()
    {
        $login = request()->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$field => $login]);

        return $field;
    } */


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

        // User exists but already logged in
        $isLoggedIn = $user ? $user->logged_in : false;
        $customMsg = $isLoggedIn ? 'True' : null;
        $owner = $user ? $user->serial : null;

        if (($isLoggedIn === 0) && $this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request, $customMsg, $owner);
    }

    /* protected function checkLogginStatus(Request $request)
    {
        return $this->getUserFromRequest($request) ? $this->getUserFromRequest($request)->logged_in : false;
    } */


    protected function getUserFromRequest(Request $request)
    {
        $user =  User::where('email', $request->email)->get();
        return count($user) ? $user->first() : null;
    }


    protected function sendFailedLoginResponse(Request $request, $customMessage=null, $owner=null)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            "customMessage" => $customMessage,
            "errorOwner" => $owner
        ]);
    }
    public function authenticated(Request $request, User $user)
    {
        $user->logged_in = 1;
        $user->save();
        return redirect()->intended($this->redirectPath());
    }

    // when user click on log out from all devices
// store a cookie that will be used on the next login attempt
    /* public function logoutAllDevices(Request $request)
    {
        if ($request->ajax()) {
            $owner_serial = $request->owner ?? null;
            if ($owner_serial) {
                $user = User::where('serial', $owner_serial)->first();
                if ($user) {
                    Auth::setUser($user)->logoutOtherDevices($user->password);
                    return response()->json('All devices logged out', 200);
                }
            }
        }

        return response()->json('Invalid Data provided', 303);
    } */
}