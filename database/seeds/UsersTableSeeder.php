<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'thang',
            'email' => 'npthang@gmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'fullname' => 'nguyen phuoc thang',
            'level' => 1,
            'avatar' => 'avatar.png',
        ]);

        $faker = Faker\Factory::create();
        factory(App\User::class, 20)
        ->create();
    }
}
