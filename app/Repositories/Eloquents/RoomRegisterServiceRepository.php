<?php

namespace App\Repositories\Eloquents;

use App\Models\RoomRegisterService;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


class RoomRegisterServiceRepository extends BaseRepository {
    public function __construct(RoomRegisterService $model)
    {
        $this->model = $model;
    }



}
