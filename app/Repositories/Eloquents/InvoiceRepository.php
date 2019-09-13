<?php

namespace App\Repositories\Eloquents;

use App\Models\Invoice;
use App\Repositories\Base\BaseRepository;



class InvoiceRepository extends BaseRepository {
    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }



}
