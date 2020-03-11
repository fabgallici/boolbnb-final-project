<?php

namespace App\Http\Controllers;
use Braintree_Gateway;
use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
use App\Ad;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PaymentsController extends Controller
{
     public function pay(Request $request,$id)
    {
        if(isset($request->payID)){
            $apartment = Apartment::findOrFail($request->payID);
        } else{
            $apartment = Apartment::find($id);
        }
        //devo estrarre il prezzo dell'ad e mandarlo alla pag del pagamento
        $adId=($request-> ads);
        $query = Ad::where('id','=',$adId)->select('price')->get();
        $price = $query[0]->price;

        return view('hosted',compact('apartment','price'));

    }

    public function make(Request $request,$id,$adId)
{
    if(isset($request->payID)){
        $apartment = Apartment::findOrFail($request->payID);
    } else{
        $apartment = Apartment::findOrFail($id);
    }
  //$data = $request -> all();

 //CONNETTERE APARTMENT E AD NELLA TABELLA PIVOT , ATTACH ? SYNCH?


  $ad = Ad::findOrFail($adId);
 // dd($ad);
//uso attach o sync per dirgli di tenermi l'elemento selezionato
  $apartment -> ads() -> attach($ad);
  //dd($apartment);

 //collegamento

       $ads = Ad::all();

       $gateway = new Braintree_Gateway([
                                         'environment' => 'sandbox',
                                         'merchantId' => '8w4hz737npfm33s6',
                                         'publicKey' => 'mq73dj8hqrtn4pvx',
                                         'privateKey' => 'dbad4bb9942aadf39b167d980dcb0893'
                                         ]);

    $paymentMethodNonce =  $_POST['payment_method_nonce'];
    $amount = $_POST['amount'];

    $time;
    if ($amount == '2.99') {
      $time = '24';

    } else if($amount == '5.99'){
      $time = '72';
    }
    else if($amount == '9.99'){
      $time = '144';
    }

     $today = Carbon::now();
     $new_expire= new Carbon($today->addHours($time));
     $diff= $new_expire-> diffInRealHours($today,false);


    //aggiorno l'expire-date
          DB::table('ad_apartment')
                    ->where('apartment_id',$id)
                    ->update(['expire_date' => $new_expire]);

          DB::table('apartments')
                    ->where('id',$id)
                    ->update(['ads_expired' => $new_expire]);



        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $apartments= Apartment::all();
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $paymentMethodNonce,
            'options' => [
            'submitForSettlement' => True
                ]]);

      if($result ->success){

        return view('pages.info-sponsor',compact('apartment','amount','time','today','new_expire'));

      }
      else{



        $result = 'Il pagamento non è andato a buon fine';
        $apartments = Apartment::findOrFail($id);
        return view('pages.rejected',compact('result','apartments'));

      }
}

 public function sponsor($id)
    {
      $apId = $id;

      $apartment = Apartment::find($id);

       return redirect('/user/apartment/'.$id)->with([
        'apartment' => $apartment
        ]);

     // return redirect('/user/apartment/'.$id)->with(['successo' => $successo]);


    }
}
