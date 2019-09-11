<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'room_code'       => 'Default 1',
            'room_name'       => 'Default 1',
            'id_type'         => 1,
            'id_floor'        => 1,
            'number_count'    => 5,
            'status'          =>'0',
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);
        DB::table('rooms')->insert([
            'room_code'       => 'Default 2',
            'room_name'       => 'Default 2',
            'id_type'         => 2,
            'id_floor'        => 2,
            'number_count'    => 2,
            'status'          =>'0',
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);
    }
}
