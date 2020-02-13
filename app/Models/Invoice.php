<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Invoice extends BaseModel
{
    protected $table = 'invoices';
    protected $fillable = ['id','code','id_register_room','id_user','invoice_price','del_flg','has_finish','has_report'];
}
