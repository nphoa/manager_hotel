<?php

namespace App\Listeners;

use App\Events\UpdateCustomer;
use App\Repositories\Eloquents\RoomRegisterCustomerRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateRoomRegisterCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $roomRegisterCustomerRepository;
    public function __construct(RoomRegisterCustomerRepository $roomRegisterCustomerRepository)
    {
        $this->roomRegisterCustomerRepository = $roomRegisterCustomerRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UpdateCustomer $event)
    {
        $instance = $this->roomRegisterCustomerRepository->getByAttribute(array('id_customer'=>$event->customer->id));
        //$instance_chunk = array_chunk($instance->toArray(),2);
        //$instance = get_object_vars($instance);
        if(count($instance->toArray()) > 0){
            $conditions = [
               'id_customer' => $event->customer->id
            ];
            $attributes = [
                'fullName'     => $event->customer->fullName,
                'phoneNumber'  => $event->customer->phoneNumber,
                'identityCard' => $event->customer->identityCard
            ];
            $this->roomRegisterCustomerRepository->updateInstances($attributes,$conditions);
        }
        //var_dump($instance_chunk);
        //die('lister update customer');

    }
}
