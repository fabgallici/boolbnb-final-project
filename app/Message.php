<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        "body",
        "title",
        "email"
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
