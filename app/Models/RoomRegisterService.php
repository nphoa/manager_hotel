<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomRegisterService extends BaseModel
{
    protected $table = 'room_register_services';
    protected $fillable = ['id_room_register','id_service','count','price','price_discount'];
}
