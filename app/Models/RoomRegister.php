<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomRegister extends BaseModel
{
    protected $table = 'room_register';
    protected $fillable = ['id','id_room','id_customer','date_check_in','date_check_out','note','status','del_flg'];
}
