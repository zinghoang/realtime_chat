<?php

use Illuminate\Database\Seeder;

class PrivatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(App\PrivateMessage::class, 20)
        ->create();
    }
}
