<?php

namespace App\Http\Controllers;

use App\Message;
use App\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    public function store(Request $request) {

        $toSend = $request -> all();
        $mail = Auth::user() ? Auth::user() -> email : $_POST['email'];
        $data = Message::make([
            "body" => $request['text'],
            "title" => 'prova',
            "email" => $mail
        ]);

        $apartment = Apartment::findOrFail($request['id-apt']);
        $apartment->messages()->save($data);
        // return redirect() -> route('mail-send');
        return Redirect::route('mail-send', $toSend['text']);
    }



    public function sendMail(Request $request, $toSend) {

        $to_email = "from@example.com";
        // $data = ['msg' => $toSend];
        $data = array("body" => $toSend);
        Mail::send('mail', $data, function ($message) use ($to_email) {
            $message -> to($to_email)
                     -> subject('Mail object');
        });

        return redirect() -> back();
    }


    //  public function stat(Request $request) {
       
    //     $year_jq = $request -> year_jq;
    //      $msgs = Message::where('apartment_id', '=', $id) 
    //              -> whereYear('created_at', '=', $year_jq)
    //              -> select('created_at')
    //             -> get();
                
    //    return response() -> json($msgs);
    // }
}

