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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Administrator',
            'level' => 1,
            'avatar' => '7iinUelyHGVYeIWGRZOKEl2yMzbUTcHxNnmPESgK.png',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('users')->insert([
            'name' => 'thaivanloidn',
            'email' => 'thaivanloidn@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Thai Van Loi',
            'level' => 1,
            'avatar' => 'El2yMzbUTcHxNnmPESgK7iinUelyHGVYeIWGRZOK.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('users')->insert([
            'name' => 'thangnp',
            'email' => 'thangnp@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Nguyen Phuoc Thang',
            'level' => 1,
            'avatar' => 'ESgK7iinUelyHGVYeIWGRZOKEl2yMzbUTcHxNnmP.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('users')->insert([
            'name' => 'linhnm',
            'email' => 'linhnm@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Nguyen Manh Linh',
            'level' => 1,
            'avatar' => '2yMzbUTcHxNnmPESgK7iinUelyHGVYeIWGRZOKEl.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('users')->insert([
            'name' => 'zhuukhanhz',
            'email' => 'zhuukhanhz@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Nguyen Huu Khanh',
            'level' => 1,
            'avatar' => 'gK7iinUelyHGVYeIWGRZOKEl2yMzbUTcHxNnmPES.jpg',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('users')->insert([
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'fullname' => 'Member',
            'level' => 0,
            'avatar' => 'avatar.png',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        $faker = Faker\Factory::create();
        factory(App\User::class, 20)
        ->create();
    }
}
