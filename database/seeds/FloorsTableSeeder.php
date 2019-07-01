<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('floors')->insert([
            'floor_name' => 'F_1',
            'room_number' => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('floors')->insert([
            'floor_name' => 'F_2',
            'room_number' => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('floors')->insert([
            'floor_name' => 'F_3',
            'room_number' => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('floors')->insert([
            'floor_name' => 'F_4',
            'room_number' => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('floors')->insert([
            'floor_name' => 'F_5',
            'room_number' => 4,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('floors')->insert([
            'floor_name' => 'F_6',
            'room_number' => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
