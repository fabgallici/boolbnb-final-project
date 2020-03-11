<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class provaController extends Controller
{
    public function Array(){
         $myObj = [

                ['color' =>'red',
                'fruit'=> 'fragola'
                ],
                
                ['color' =>'yellow',
                    'fruit'=> 'banana'
                ],

                ['color' =>'green',
                    'fruit'=> 'kiwi'
                ]

    ];
    //$prova= e(collect($myObj));
    //dd($prova);
    $prova = json_encode($myObj);
        return view('pages.prova',compact('prova'));
    }
}
