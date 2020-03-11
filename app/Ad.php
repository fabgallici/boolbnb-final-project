<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        "price"
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class)->withTimestamps()->withPivot('expire_date');
    }
}
