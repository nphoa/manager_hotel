<?php

namespace App\Repositories\Eloquents;


use App\Models\Customer;
use App\Models\Floor;
use App\Models\Room;
use App\Repositories\Base\BaseRepository;

class RoomRepository extends BaseRepository {
    public function __construct(Room $model)
    {
        $this->model = $model;
    }
}
