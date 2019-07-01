<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0;$i<=10;$i++){
            DB::table('employees')->insert([
                'fullName' => $faker->name,
                'birthday' => $faker->date('Y-m-d'),
                'address' => $faker->address,
                'phoneNumber' => $faker->phoneNumber,
                'identityCard' => $faker->sentence(10),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()

            ]);
        }

    }
}
