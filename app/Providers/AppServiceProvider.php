<?php

namespace App\Providers;

use App\Models\Floor;
use App\Models\RoomType;
use App\Repositories\Eloquents\FloorRepository;
use App\Repositories\Eloquents\RoomTypeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RoomTypeRepository', function ($app) {
            return new RoomTypeRepository(new RoomType());
        });
        $this->app->bind('FloorRepository', function ($app) {
            return new FloorRepository(new Floor());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
