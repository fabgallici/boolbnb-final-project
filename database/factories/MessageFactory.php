<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Message;


$factory->define(Message::class, function (Faker $faker) {
    return [
        'title' => $faker -> word,
        'body' => $faker -> sentence,
        'email' => $faker -> email
    ];
});