<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'name' => 'yMzbUTcHxNnmPESgK7iinUelyHGVYeIWGRZOKEl2.mp4',
            'room_id' => 1,
            'type' => 'video',
            'title' => 'CGI Animated Short Film HD',
            'user_id' => 1,

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('files')->insert([
            'name' => 'iinUelyHGVYeIWGRZOKEl2yMzbUTcHxNnmPESgK7.mp4',
            'room_id' => 1,
            'type' => 'video',
            'title' => 'Short Animation Alarm',
            'user_id' => 2,

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('files')->insert([
            'name' => 'eIWGRZOKEl2yMzbUTcHxNnmPESgK7iinUelyHGVY.mp3',
            'room_id' => 1,
            'type' => 'sound',
            'title' => 'Jingle Bells Boney M',
            'user_id' => 3,

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('files')->insert([
            'name' => 'bUTcHxNnmPESgK7iinUelyHGVYeIWGRZOKEl2yMz.mp3',
            'room_id' => 1,
            'type' => 'sound',
            'title' => 'Happy New Year',
            'user_id' => 4,

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
