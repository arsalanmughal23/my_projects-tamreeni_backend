<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Flash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        if(!$user) {
            $this->logout($request);
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }

        if (!$user->hasAnyRole([Role::SUPER_ADMIN, Role::ADMIN, ...Role::MENTOR])) {
            $this->logout($request);
            return abort(403, 'User does not have the right role.');
            // $this->logout($request);
            // Flash::error('User does not have the right role.');
            // return redirect('/login');
        }

        // Redirect the user to a specific route for users with these roles
        // return redirect()->route('home');
        return redirect()->intended($this->redirectPath());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
