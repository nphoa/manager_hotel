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

    public function __get($attribute)
    {
        if($attribute === 'serviceInstance' && !isset( $this->attributes[$attribute])){
            $serviceInstance = resolve('ServiceRepository')->getById($this->attributes['id_service']);
            $data = array(
                'serviceName'   => $serviceInstance->service_name,
                'servicePrice'  => $serviceInstance->service_price
            );
            $this->attributes['serviceInstance'] = $data;
        }
        return $this->getAttribute($attribute);
    }
}
