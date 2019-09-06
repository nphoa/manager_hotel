<?php

namespace App\Repositories\Eloquents;

use App\Models\RoomRegisterCustomer;
use App\Repositories\Base\BaseRepository;



class RoomRegisterCustomerRepository extends BaseRepository {
    public function __construct(RoomRegisterCustomer $model)
    {
        $this->model = $model;
    }



}
