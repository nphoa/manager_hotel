<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomPrice extends BaseModel
{
    protected $table = 'room_prices';
    protected $fillable = ['type_price','price','discount'];
}
