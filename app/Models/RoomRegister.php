<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Carbon\Carbon;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomRegister extends BaseModel
{
    protected $table = 'room_register';
    protected $fillable = [
                    'id',
                    'id_room',
                    'date_check_in',
                    'id_room_price',
                    'service_invoice',
                    'room_price_invoice',
                    'date_check_out',
                    'note',
                    'status',
                    'del_flg',
                    'fromTime',
                    'toTime'
    ];



}
