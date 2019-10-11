<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Image extends BaseModel
{
    protected $table = 'images';
    protected $fillable = ['relation_name','relation_id','name','url'];
}
