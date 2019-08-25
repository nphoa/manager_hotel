<?php

namespace App\Repositories\Eloquents;


use App\Models\Customer;
use App\Models\Floor;
use App\Models\Service;
use App\Repositories\Base\BaseRepository;

class ServiceRepository extends BaseRepository {
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}
