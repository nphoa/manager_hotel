<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('room_type')->insert([
            'name' => 'Single',
            'single_bed_count' => 1,
            'double_bed_count' => 0,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('room_type')->insert([
            'name' => 'Double',
            'single_bed_count' => 0,
            'double_bed_count' => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('room_type')->insert([
            'name' => 'More',
            'single_bed_count' => 0,
            'double_bed_count' => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

    }
}
