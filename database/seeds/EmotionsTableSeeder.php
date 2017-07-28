<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emotions')->insert([
            'name' => 'Adore',
            'image' => 'adore.png',
            'code' => ':o',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Ah',
            'image' => 'ah.png',
            'code' => '=)',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Amazed',
            'image' => 'amazed.png',
            'code' => ':|',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Angry',
            'image' => 'angry.png',
            'code' => '><',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Byebye',
            'image' => 'byebye.png',
            'code' => ':h',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Big Smile',
            'image' => 'big_smile.png',
            'code' => ':D',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Smile',
            'image' => 'smile.png',
            'code' => ':)',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Cry',
            'image' => 'cry.png',
            'code' => ":'(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Sad',
            'image' => 'sad.png',
            'code' => ":(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Look Down',
            'image' => 'look_down.png',
            'code' => ":`",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Bad Smelly',
            'image' => 'bad_smelly.png',
            'code' => ":'D",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Beauty',
            'image' => 'beauty.png',
            'code' => "<3",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Hell Boy',
            'image' => 'hell_boy.png',
            'code' => "XD",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Boss',
            'image' => 'boss.png',
            'code' => ":B",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Canny',
            'image' => 'canny.png',
            'code' => ":#",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
