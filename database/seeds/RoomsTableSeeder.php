<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\User;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(App\Room::class, 20)
        ->create([
            'name' => $faker->name,
            'user_id' => function () {
                return factory(App\User::class)->create()->id;
            }
        ]);
    }
}
