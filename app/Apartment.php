<?php

namespace App;

use App\Stat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Apartment extends Model
{
    protected $fillable =[
        'title',
        'description',
        'image',
        'address',
        'lat',
        'lon',
        'rooms',
        'beds',
        'bath',
        'square_mt',
        'ads_expired',
        'show',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function configs()
    {
        return $this->belongsToMany(Config::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class)->withTimestamps()->withPivot('expire_date');
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function viewsCount($request, $id, $apartment) {
        if (Auth::id() !== $apartment -> user -> id) {
        //implementing view counter with sessions
        $apartKey = 'apart_' .$id;

            if(!$request->session()->has($apartKey)) {
                $request->session()->put('apart_' .$id, 1);
                //update view counter apartment
                $apartment->increment('views');

                $stat = Stat::make();
                $stat->apartment()->associate($apartment);
                $stat->save();
            }
        }
    }
}
