<?php

namespace App\Repositories\Eloquents;


use App\Models\Customer;
use App\Repositories\Base\BaseRepository;

class CustomerRepository extends BaseRepository {
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}
