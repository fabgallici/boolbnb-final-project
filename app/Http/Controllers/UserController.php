<?php

namespace App\Http\Controllers;

use App\Ad;

use App\Config;
use App\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Inline\Element\Code;

class UserController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function show(Request $request, $id)
    {

        $apartment= Apartment::findOrFail($id);
        $ads = Ad::all();
        $apartment -> viewsCount($request, $id, $apartment);

        return view('pages.show',compact('apartment','ads'));
    }



    public function create()
    {

        return view('pages.user.create-apt', [
            'configs' => Config::all()
         ]);
    }


    public function store(Request $request) {

        // return Response()->json($request); //debug
        $validateApartmentData = $request -> validate([
            'imagefile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:850',
            'description' => 'required|max:850',
            'address' => 'required|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-90,180',
            'rooms' => 'required|integer|max:200',
            'beds' => 'required|integer|max:200',
            'bath' => 'required|integer|max:200',
            'square_mt' => 'required|integer|max:10000',
            'configs_id' => 'nullable|array|exists:configs,id',
            'show' => 'required|integer|min:0|max:1'
        ]);

        if ($validateApartmentData) {

            if (isset($validateApartmentData['imagefile'])) {


                $file = $request->file('imagefile');
                $filename = $file -> getClientOriginalName();
                $file -> move('images/user/'. Auth::user()->name, $filename);
                //save image path db da verificare
                $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
                $validateApartmentData['image'] = $imageFilePath;
            } else {
                $validateApartmentData['image'] = 'images/user/default-apart.jpg';
            }

            //creo Appartamento e lo associo allo user
            $user = Auth::user();
            $apartment = Apartment::make($validateApartmentData);
            $apartment -> user() -> associate($user);
            $apartment -> save();
            //associo le configs allo user apartment
            if (isset($validateApartmentData['configs_id'])) {
                $configs = Config::find($validateApartmentData['configs_id']);
                $apartment -> configs() -> attach($configs);
            }

            return Response()->json([
                "success" => true,
                "description" => $validateApartmentData['description'],
                "apart_id" => $apartment->id
            ]);

        }


        return Response()->json([
                "success" => false,
                "imagefile" => ''
            ]);
    }


    public function edit($id)
    {
        $apartment =Apartment::find($id);
        $configs=Config::all();
        return view('pages.user.update-apt',compact('apartment','configs'));
    }


    public function update(Request $request)
    {
        // return Response()->json($request); //debug
        $validateApartmentData = $request -> validate([
            'id' => 'required|exists:apartments,id',
            'imagefile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:850',
            'description' => 'required|max:850',
            'address' => 'required|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-90,180',
            'rooms' => 'required|integer|max:200',
            'beds' => 'required|integer|max:200',
            'bath' => 'required|integer|max:200',
            'square_mt' => 'required|integer|max:10000',
            'configs_id' => 'nullable|array|exists:configs,id',
            'show' => 'required|integer|min:0|max:1'
        ]);

        $userId = Auth::id();
        $apartment = Apartment::findOrFail($validateApartmentData['id']);

        if ($validateApartmentData
            && ($userId == $apartment -> user -> id)) {
            if (isset($validateApartmentData['imagefile'])) {
                $file = $request->file('imagefile');
                $filename = $file -> getClientOriginalName();
                $file -> move('images/user/'. Auth::user()->name, $filename);
                //save image path db da verificare
                $imageFilePath = 'images/user/'. Auth::user()->name.'/'. $filename;
                $validateApartmentData['image'] = $imageFilePath;
            }

            $apartment->update($validateApartmentData);

            if (isset($validateApartmentData['configs_id'])) {

                $configs = Config::find($validateApartmentData['configs_id']);
                $apartment->configs()->sync($configs);
            } else {
                $apartment->configs()->detach();
            }

            return Response()->json([
                "success" => true,
                "description" => $validateApartmentData['description'],
                "apart_id" => $apartment->id
            ]);
        }


        return Response()->json([
                "success" => false,
                "imagefile" => ''
            ]);

    }


    public function destroy(Request $request)
    {

        $id = $request->del_apart;
        $apartment = Apartment::findOrFail($id);
        $apartment->configs()->sync([]);
        $apartment->delete();
        if(isset($request->home)){
            return redirect('/');
        } else {
            return back();
        }
        //return redirect()->route('all.index');// nuova modifica
    }

    public function userPanel()
    {
        $user = Auth::user();
        $countMsg = 0;
        $allAdsApt = collect([]);;
        $allMsgsApt = collect([]);
        $activeCount = collect([]);
        $apartments = $user -> apartments() -> get();
        $countHide = $apartments->where('show','=', 0);
        $adsTypo =AD::all();
        foreach ($apartments as $apartment) {
            $countMsg += $apartment->messages()->count();
            if (($apartment->messages()->where('apartment_id', '=', $apartment->id))->exists()) {
                $allMsgsApt->push(
                    $apartment->messages()->where('apartment_id', '=', $apartment->id)->get()
                );
            };
            foreach ($apartment->ads as $ad) {
                $adsActive = $ad->pivot->expire_date;
                $allAdsApt->push(
                    $adsActive
                );
                if(Carbon::now()->diffInDays($adsActive, false) >= 0){
                    $activeCount->push(
                        $adsActive
                    );
                }

            }
        };


        $$allMsgsApt = collect([['number' => 1],['number' => 2],['number' => 3]]);
        $$allMsgsApt->all();
        return view('pages.user.user-panel', compact(   'apartments',
                                                        "countMsg",'allMsgsApt',
                                                        'countHide',
                                                        'allAdsApt',
                                                        'adsTypo',
                                                        'activeCount'
                                                    ));
    }

    /* public function search(Request $request)
    {
        dd();
        $data = $request -> all();
        $result = strtolower($data['search_field']);
        $apartments = Apartment::where('address', 'LIKE',strtolower('%'.$result.'%'))->get();
        return view('pages.search',compact('apartments', 'result'));
    } */


    // public function show($id)
    // {
    //     $apartment= Apartment::findOrFail($id);
    //     return view('pages.show',compact('apartment'));
    // }

}

