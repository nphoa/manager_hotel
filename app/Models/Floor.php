<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Floor extends BaseModel
{
    protected $table = 'floors';
    protected $fillable = ['id','floor_name','room_number','del_flg'];
}
