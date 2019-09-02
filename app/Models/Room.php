<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use App\Repositories\Eloquents\RoomTypeRepository;

/**
 * Class BaseModel
 * @package App\Models\Base
 */
class Room extends BaseModel
{
    protected $table = 'rooms';
    protected $fillable = ['id','room_code','room_name','id_type','id_floor','price','number_count','has_register','note','del_flg'];
    protected $status = array(
        '0'   => 'Empty',
        '1'   => 'Check In',
        '2'   =>  'Check Out',
    );
    public function __get($attribute)
    {
        if($attribute === 'typeName' && !isset( $this->attributes[$attribute])){
            $this->attributes['typeName'] = resolve('RoomTypeRepository')->getById($this->attributes['id_type'])->name;
        }
        if($attribute === 'floorName' && !isset( $this->attributes[$attribute])){
            $this->attributes['floorName'] = resolve('FloorRepository')->getById($this->attributes['id_floor'])->floor_name;
        }
        if($attribute === 'statusName' && !isset( $this->attributes[$attribute])){
            $this->attributes['statusName'] = $this->status[$this->attributes['status']];
        }
        return $this->getAttribute($attribute);
    }





}
