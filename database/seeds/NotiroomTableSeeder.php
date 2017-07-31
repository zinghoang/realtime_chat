<?php

use Illuminate\Database\Seeder;

class NotiroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifroom')->insert([
            'roomid' => '1',
            'userid' => '1',
            'status' => '0',
        ]);

        DB::table('notifroom')->insert([
            'roomid' => '1',
            'userid' => '2',
            'status' => '0',
        ]);

        DB::table('notifroom')->insert([
            'roomid' => '1',
            'userid' => '3',
            'status' => '0',
        ]);

        DB::table('notifroom')->insert([
            'roomid' => '1',
            'userid' => '4',
            'status' => '0',
        ]);

        DB::table('notifroom')->insert([
            'roomid' => '1',
            'userid' => '5',
            'status' => '0',
        ]);
    }
}
