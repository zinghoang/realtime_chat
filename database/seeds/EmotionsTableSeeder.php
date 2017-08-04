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

        DB::table('emotions')->insert([
            'name' => 'After Boom',
            'image' => 'after_boom.png',
            'code' => "o0",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Baffle',
            'image' => 'baffle.png',
            'code' => ":`(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Beat Brick',
            'image' => 'beat_brick.png',
            'code' => ":'#",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Beated',
            'image' => 'beated.png',
            'code' => "x.o",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Beat Plaster',
            'image' => 'beat_plaster.png',
            'code' => "X|",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Beat Shot',
            'image' => 'beat_shot.png',
            'code' => "0|",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Burn Joss Stick',
            'image' => 'burn_joss_stick.png',
            'code' => "o|o",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Choler',
            'image' => 'choler.png',
            'code' => ">|",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Cold',
            'image' => 'cold.png',
            'code' => "-.-",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Confident',
            'image' => 'confident.png',
            'code' => ">(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Confuse',
            'image' => 'confuse.png',
            'code' => ":-|",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Cool',
            'image' => 'cool.png',
            'code' => ":-(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Doubt',
            'image' => 'doubt.png',
            'code' => "|(",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Dribble',
            'image' => 'dribble.png',
            'code' => "0o",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Embarrassed',
            'image' => 'embarrassed.png',
            'code' => "o.-",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Extreme Sexy Girl',
            'image' => 'extreme_sexy_girl.png',
            'code' => "://",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Feel Good',
            'image' => 'feel_good.png',
            'code' => "^^",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Go',
            'image' => 'go.png',
            'code' => ">>",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Ha ha',
            'image' => 'haha.png',
            'code' => ":-D",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Hungry',
            'image' => 'hungry.png',
            'code' => ":00",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Matrix',
            'image' => 'matrix.png',
            'code' => "--!",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('emotions')->insert([
            'name' => 'Misdoubt',
            'image' => 'misdoubt.png',
            'code' => ":0",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
