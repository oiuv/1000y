<?php

use Carbon\Carbon;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = Carbon::now()->toDateTimeString();

    return [
        'account'        => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        //'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'password'       => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
        'introduction'   => $faker->sentence(),
        //'makedate'       => $now,
        //'updated_at'     => $now,
    ];
});
