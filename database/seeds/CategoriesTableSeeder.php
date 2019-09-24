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
                'url'  => '/customers',
                'icon' => 'fa fa-user'
            ],
            [
                'name' => 'Employee',
                'url'  => '/employees',
                'icon' => 'fa fa-user'
            ],
            [
                'name' => 'Floor',
                'url'  => '/floors',
                'icon' => 'fa fa-sitemap'
            ],
            [
                'name' => 'Room',
                'url'  => '/rooms',
                'icon' => 'fa fa-table'
            ],
            [
                'name' => 'Service',
                'url'  => '/services',
                'icon' => 'fa fa-edit'
            ],
            [
                'name' => 'Checkin/Checkout',
                'url'  => '/checkinorcheckout',
                'icon' => 'fa fa-key'
            ],
            [
                'name' => 'History',
                'url'  => '/history',
                'icon' => 'fa fa-book'
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
