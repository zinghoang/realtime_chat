<?php

use Illuminate\Database\Seeder;

class MessengesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(App\Messenges::class, 20)
        ->create();
    }
}
