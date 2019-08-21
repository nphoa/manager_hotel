<?php

namespace App\Models;

use App\Models\Base\BaseModel;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Category extends BaseModel
{
    protected $table = 'categories';
    protected $fillable = ['name','url'];
}
