<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EmotionsTableSeeder::class);

        $this->call(RoomsTableSeeder::class);
        $this->call(RoomUsersTableSeeder::class);
        $this->call(FilesTableSeeder::class);

        $this->call(MessengesTableSeeder::class);

        $this->call(PrivatesTableSeeder::class);
        
        $this->call(FriendShipTableSeeder::class);
        
        $this->call(NotiroomTableSeeder::class);
        $this->call(NotiprivateTableSeeder::class);
    }
}
