<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\User;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => 'General',
            'user_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Talon Braun',
            'user_id' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Kaylie Bruen',
            'user_id' => '3',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Kallie Quitzon',
            'user_id' => '4',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Freeda Stracke',
            'user_id' => '5',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Oswaldo Hettinger',
            'user_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Kristopher Hayes',
            'user_id' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Ceasar Tromp',
            'user_id' => '3',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Erling Bogan',
            'user_id' => '4',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Kennedy Schmitt',
            'user_id' => '5',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Darwin Little',
            'user_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Lucile Rau',
            'user_id' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Matteo Heaney',
            'user_id' => '3',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Tess Streich MD',
            'user_id' => '4',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Patricia Nienow',
            'user_id' => '5',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Jeffry Lesch',
            'user_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Odell Willms',
            'user_id' => '2',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Elva Steuber',
            'user_id' => '3',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Dino Cormier',
            'user_id' => '4',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('rooms')->insert([
            'name' => 'Savanah Mraz',
            'user_id' => '5',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
