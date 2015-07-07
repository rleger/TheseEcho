<?php

namespace These\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use These\Http\Controllers\Controller;
use These\Http\Requests\LoginRequest;
use These\Events\UserHasLoggedIn;
use These\Events\UserHasLoggedOut;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard      $auth
     * @param Dispatcher $dispatcher
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     *
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        if (auth()->attempt($request->only('username', 'password'))) {
            event(new UserHasLoggedIn($request->username));

            return redirect()->intended('/');
        }

        return redirect('/auth/login')->withErrors([
            'email' => 'Cette combinaison identifiant/mot de passe est incorrecte.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        event(new UserHasLoggedOut(auth()->user()->username));

        auth()->logout();

        return redirect('/');
    }
}
