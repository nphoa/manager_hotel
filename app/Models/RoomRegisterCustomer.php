<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class RoomRegisterCustomer extends BaseModel
{
    protected $table = 'room_register_customers';
    protected $fillable = ['id_room_register','id_customer','fullName','phoneNumber','identityCard','is_member','del_flg'];


}
