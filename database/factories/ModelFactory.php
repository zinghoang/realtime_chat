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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'fullname' => $faker->name,
        'level' => 0,
        'avatar' => 'avatar.png',
    ];
});

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\PrivateMessage::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text,
        'from' => function () {
            return factory(App\User::class)->create()->id;
        },
        'to' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Messenges::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text,
    	'status' => '1',
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'room_id' => function () {
        	return factory(App\Room::class)->create()->id;
        }
    ];
});

$factory->define(App\File::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => 'title',
        'type' => 'type',
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'room_id' => function () {
        	return factory(App\Room::class)->create()->id;
        }
    ];
});