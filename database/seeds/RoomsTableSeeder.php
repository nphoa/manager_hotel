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
            'room_code'       => 'Default',
            'room_name'       => 'Default',
            'id_type'         => 1,
            'id_floor'        => 1,
            'price'           =>'150000',
            'number_count'    => 5,
            'status'          =>'0',
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now()
        ]);
    }
}
