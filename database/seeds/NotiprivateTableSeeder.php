<?php

use Illuminate\Database\Seeder;

class NotiprivateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifprivate')->insert([
            'from' => '1',
            'to' => '2',
            'status' => '0',
        ]);

        DB::table('notifprivate')->insert([
            'from' => '2',
            'to' => '3',
            'status' => '0',
        ]);

        DB::table('notifprivate')->insert([
            'from' => '3',
            'to' => '4',
            'status' => '0',
        ]);

        DB::table('notifprivate')->insert([
            'from' => '4',
            'to' => '5',
            'status' => '0',
        ]);

        DB::table('notifprivate')->insert([
            'from' => '5',
            'to' => '6',
            'status' => '0',
        ]);

        DB::table('notifprivate')->insert([
            'from' => '6',
            'to' => '1',
            'status' => '0',
        ]);
    }
}
