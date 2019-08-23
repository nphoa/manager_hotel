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
            [
                'name' => 'Customer',
                'url'  => '/customer',
                'icon' => 'fa fa-user'
            ],
            [
                'name' => 'Employee',
                'url'  => '/employee',
                'icon' => 'fa fa-user'
            ],
            [
                'name' => 'Floor',
                'url'  => '/floor',
                'icon' => 'fa fa-sitemap'
            ],
            [
                'name' => 'Room',
                'url'  => '/room',
                'icon' => 'fa fa-table'
            ],
            [
                'name' => 'Service',
                'url'  => '/service',
                'icon' => 'fa fa-edit'
            ],
            [
                'name' => 'RoomRegister',
                'url'  => '/roomRegister',
                'icon' => 'fa fa-key'
            ],
        ];
        foreach ($categories as $key => $category){
            DB::table('categories')->insert([
                'name'          => $category['name'],
                'url'           => $category['url'],
                'icon'          => $category['icon'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }
}
