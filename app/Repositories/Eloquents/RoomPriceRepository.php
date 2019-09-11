<?php

namespace App\Repositories\Eloquents;

use App\Models\RoomPrice;
use App\Repositories\Base\BaseRepository;



class RoomPriceRepository extends BaseRepository {
    public function __construct(RoomPrice $model)
    {
        $this->model = $model;
    }



}
