<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'fullName' => 'NguyễnPH',
            'birthday' => Carbon::now(),
            'address'  => '155/24 XVNT p17 Quan.BT',
            'phoneNumber' => '0773492274',
            'identityCard' => '123456',
            'national'     => 'vn'
        ]);
    }
}
