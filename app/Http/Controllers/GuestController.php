<?php

namespace App\Http\Controllers;

use App\User;
use App\Apartment;
use App\Config;
use App\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class GuestController extends Controller
{
    public function __construct()
    {
        $this -> middleware('guest') -> except(['login','index']);
    }


    public function index()
    {
        $users = User::all();
        $adApts = Apartment::where('ads_expired','<>','0') -> inRandomOrder() -> limit(9) -> get();
        // $aptChunk = $adApts -> chunk(3);
        // dd($adApts);
        $apartments = Apartment::orderBy('id', 'DESC') -> paginate(9);

        return view('pages.index',compact('users','apartments', 'adApts'));
    }


    public function show(Request $request, $id)
    {
        $apartment= Apartment::findOrFail($id);
        $apartment -> viewsCount($request, $id, $apartment);
        return view('pages.show',compact('apartment'));
    }


    public function create()
    {

        return view('pages.user.create-apt', [
            'configs' => Config::all()
        ]);
    }

}
