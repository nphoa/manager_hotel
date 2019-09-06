<?php

namespace App\Providers;

use App\Models\Floor;
use App\Models\RoomType;
use App\Models\Service;
use App\Repositories\Eloquents\FloorRepository;
use App\Repositories\Eloquents\RoomTypeRepository;
use App\Repositories\Eloquents\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use function foo\func;

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
        $this->app->bind('ServiceRepository',function ($app){
            return new ServiceRepository(new Service());
        });
        require_once app_path() . '/Helpers/Util.php';
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
