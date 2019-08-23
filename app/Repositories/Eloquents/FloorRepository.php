<?php

namespace App\Repositories\Eloquents;


use App\Models\Customer;
use App\Models\Floor;
use App\Repositories\Base\BaseRepository;

class FloorRepository extends BaseRepository {
    public function __construct(Floor $model)
    {
        $this->model = $model;
    }
}
