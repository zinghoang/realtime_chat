<?php

use Illuminate\Database\Seeder;

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
            'name' => 'adore',
            'image' => 'adore.pnd',
            'code' => ':D',
        ]);

        DB::table('emotions')->insert([
            'name' => 'after_boom',
            'image' => 'after_boom.png',
            'code' => ':B',
        ]);

        DB::table('emotions')->insert([
            'name' => 'ah',
            'image' => 'ah.png',
            'code' => '=)',
        ]);

        DB::table('emotions')->insert([
            'name' => 'amazed',
            'image' => 'amazed.png',
            'code' => ':)',
        ]);

        DB::table('emotions')->insert([
            'name' => 'angry',
            'image' => 'angry.png',
            'code' => '^^',
        ]);

        DB::table('emotions')->insert([
            'name' => 'bad_smelly',
            'image' => 'bad_smelly.png',
            'code' => ':(',
        ]);

        DB::table('emotions')->insert([
            'name' => 'byebye',
            'image' => 'byebye.png',
            'code' => '<3',
        ]);
    }
}
