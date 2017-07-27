<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => NULL,
        'fullname' => $faker->name,
        'level' => 0,
        'avatar' => 'avatar.png',
    ];
});


$factory->define(App\Messenges::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text,
        'status' => '1',
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'room_id' => $faker->numberBetween(1,20),
    ];
});

// $factory->define(App\PrivateMessage::class, function (Faker\Generator $faker) {
//     return [
//         'content' => $faker->text,
//         'from' => $faker->numberBetween(1,6),
//         'to' => $faker->numberBetween(1,6),
//     ];
// });