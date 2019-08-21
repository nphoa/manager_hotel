<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =  [
            'Customer'      => '/customer',
            'Employee'      => '/employee',
            'Floor'         => '/floor',
            'Room'          => '/room',
            'Service'       => '/service',
            'RoomRegister'  => '/roomRegister',
        ];
        foreach ($categories as $name => $url){
            DB::table('categories')->insert([
                'name' => $name,
                'url' => $url,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }
}
