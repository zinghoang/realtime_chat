<?php

use Illuminate\Database\Seeder;

class FriendShipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friendship')->insert([
            'user_request' => '1',
            'user_accept' => '2',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '2',
            'user_accept' => '3',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '3',
            'user_accept' => '4',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '4',
            'user_accept' => '5',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '5',
            'user_accept' => '6',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '6',
            'user_accept' => '7',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '7',
            'user_accept' => '1',
            'status' => '0'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '1',
            'user_accept' => '3',
            'status' => '1'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '2',
            'user_accept' => '4',
            'status' => '1'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '3',
            'user_accept' => '5',
            'status' => '1'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '4',
            'user_accept' => '6',
            'status' => '1'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '5',
            'user_accept' => '7',
            'status' => '1'
        ]);

        DB::table('friendship')->insert([
            'user_request' => '6',
            'user_accept' => '1',
            'status' => '1'
        ]);
    }
}
