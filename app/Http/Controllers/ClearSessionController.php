<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ClearSessionController extends Controller
{
    //temp only for testing Session for views count
    public function clearSession() {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
