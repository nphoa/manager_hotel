<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table('services')->insert([
            'service_name' => 'Pepsi',
            'service_price' => 10000,
            'service_employee' => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('services')->insert([
            'service_name' => 'Bia tiger',
            'service_price' => 16000,
            'service_employee' => 2,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('services')->insert([
            'service_name' => '7up',
            'service_price' => 12000,
            'service_employee' => 3,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
