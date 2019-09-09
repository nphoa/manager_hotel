<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Customer extends BaseModel
{
    protected $table = 'customers';
    protected $fillable = ['id','fullName','birthday','address','phoneNumber','identityCard','national','del_flg'];
}
