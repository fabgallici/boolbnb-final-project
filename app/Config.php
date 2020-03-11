<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        "services"
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
