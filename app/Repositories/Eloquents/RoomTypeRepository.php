<?php

namespace App\Repositories\Eloquents;


use App\Models\RoomType;
use App\Repositories\Base\BaseRepository;

class RoomTypeRepository extends BaseRepository {
    public function __construct(RoomType $model)
    {
        $this->model = $model;
    }
}
