<?php

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

$factory->define(App\User::class, function (Faker $faker) {
	$roles = App\Role::pluck('id');
    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123123'), 
        'role_id' => $faker->randomElement($roles),
        'yourname' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->state,
        'remember_token' => str_random(10),
    ];
});
