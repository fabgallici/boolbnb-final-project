<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Request;
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
    // protected $redirectTo = RouteServiceProvider::HOME;

     //temp route
    //protected $redirectTo = RouteServiceProvider::USER;

    public function showLoginForm()
    {/* , compact('status') */
        return view('auth.login');
    }


    public function redirectTo(){

        //dd(Auth::guard()->getRequest());
        $status = Auth::guard()->getRequest()->status;
        if($status == 'upr'){
            return '/user/user-panel';
        }elseif($status == 'apt'){
            return 'user/create-apt';
        }
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
