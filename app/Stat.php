<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        "stats"
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
