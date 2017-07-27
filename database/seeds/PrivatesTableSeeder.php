<?php

use Illuminate\Database\Seeder;

class PrivatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privates')->insert([
            'from' => 1,
            'to' => 2,
            'content' => 'Voluptate dolores animi pariatur Vero quidem est iste totam pariatur Dolor exercitation',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('privates')->insert([
            'from' => 2,
            'to' => 3,
            'content' => 'Dolores vero voluptas quisquam laboriosam quis voluptas iste quas et quis quia aliquam ad',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('privates')->insert([
            'from' => 3,
            'to' => 4,
            'content' => 'Eum et numquam eveniet eaque ducimus id quia eum vitae molestias',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('privates')->insert([
            'from' => 4,
            'to' => 5,
            'content' => 'Ut est sunt nihil aut molestias maiores',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('privates')->insert([
            'from' => 5,
            'to' => 6,
            'content' => 'Qui ullamco qui labore qui consequatur Et ut',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('privates')->insert([
            'from' => 6,
            'to' => 1,
            'content' => 'Fugiat est ad dolorem reiciendis',

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        // $faker = Faker\Factory::create();
        // factory(App\PrivateMessage::class, 20)
        // ->create();
    }
}
