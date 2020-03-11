<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;

class MyController extends Controller
{
    public function index(){

        $users = User::all();
     
         return view('giuseppe.giuseppe',compact('users'));
    } 
}
