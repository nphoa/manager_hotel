<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomType extends BaseModel
{
    protected $table = 'room_type';
    protected $fillable = ['id','name','single_bed_count','double_bed_count','id_quality','del_flg'];
}
