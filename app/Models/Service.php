<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Service extends BaseModel
{
    protected $table = 'services';
    protected $fillable = ['id','service_name','service_price','del_flg'];
}
