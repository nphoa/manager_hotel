<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FloorsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
//        $this->call(CustomerTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(RoomTypeTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
    }
}
