<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CustomerRepository;
use App\Repositories\Eloquents\RoomPriceRepository;
use App\Repositories\Eloquents\RoomRegisterCustomerRepository;
use App\Repositories\Eloquents\RoomRegisterRepository;
use App\Repositories\Eloquents\RoomRegisterServiceRepository;
use App\Repositories\Eloquents\RoomRepository;
use App\Repositories\Eloquents\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInCheckOutController extends Controller
{
    protected $roomRepository;
    protected $roomRegisterRepository;
    protected $serviceRepository;
    protected $roomRegisterServiceRepository;
    protected $customerRepository;
    protected $roomRegisterCustomerRepository;
    protected $roomPriceRepository;
    public function __construct(
        RoomRepository $roomRepository,
        RoomRegisterRepository $roomRegisterRepository,
        ServiceRepository $serviceRepository,
        RoomRegisterServiceRepository $roomRegisterServiceRepository,
        CustomerRepository $customerRepository,
        RoomRegisterCustomerRepository $roomRegisterCustomerRepository,
        RoomPriceRepository $roomPriceRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->roomRegisterRepository = $roomRegisterRepository;
        $this->serviceRepository = $serviceRepository;
        $this->roomRegisterServiceRepository = $roomRegisterServiceRepository;
        $this->customerRepository = $customerRepository;
        $this->roomRegisterCustomerRepository = $roomRegisterCustomerRepository;
        $this->roomPriceRepository = $roomPriceRepository;
    }

    public function index(Request $req)
    {
        //var_dump($this->roomRegisterRepository->getAll1($req));die('5');
        $dataView = [
            'rooms'     => $this->roomRegisterRepository->getAll1($req),
            'services'  => $this->serviceRepository->getAll(),
            'customers' => $this->customerRepository->getAll(),
            'roomPrice' => $this->roomPriceRepository->getAll()
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }


    public function handle(Request $req){
        $data = $req->all();
        //var_dump(json_decode(($req->get('services')))  );die('3');
        //var_dump(json_decode($data['customers']));die('3');

        DB::transaction(function () use ($data) {
            //insert table room_register and get id
            $idRoomRegister = ($this->roomRegisterRepository->create($data))->id;

            //insert table room_register_services
            $dataRoomRegisterService = json_decode( $data['services']);
            foreach ($dataRoomRegisterService as $service){
                $service->id = $service->id;
                $service->id_room_register = $idRoomRegister;
                $service->price =  floatval($service->service_price) * floatval($service->count);
                $service = get_object_vars($service);
                //var_dump($service);die('6');
                $this->roomRegisterServiceRepository->create($service);
            }

            //insert table room_register_customers
            $roomRegisterCustomers = json_decode( $data['customers']);
            foreach ($roomRegisterCustomers as $roomRegisterCustomer){
                $roomRegisterCustomer = get_object_vars($roomRegisterCustomer);
//                if($roomRegisterCustomer['is_delete'] == "1" ){
//                    $roomRegisterCustomer['del_flg'] = 1;
//                    $this->roomRegisterCustomerRepository->create($roomRegisterCustomer);
//                    continue;
//                }
                $roomRegisterCustomer['id_room_register'] = $idRoomRegister;
                $idRoomRegisterCustomer = ($this->roomRegisterCustomerRepository->create($roomRegisterCustomer))->id;
                // check if customer is member is insert to table customer
                if($roomRegisterCustomer['id_customer'] == "0" && $roomRegisterCustomer['is_member'] == "1"){
                    $customer = $roomRegisterCustomer;
                    $customer['id'] = 0;
                    $id_customer = ($this->customerRepository->create($customer))->id;
                    //update to room_register_customer
                    $roomRegisterCustomer['id'] = $idRoomRegisterCustomer;
                    $roomRegisterCustomer['id_customer'] = $id_customer;
                    $this->roomRegisterCustomerRepository->create($roomRegisterCustomer);
                }

            }
        }, 5);
        return response()->json([
           'status' => 200,
           'result' => 'Done'
        ]);
    }

    public function getInfoDetail(Request $req)
    {
        //var_dump($req->id);die('5');
        $roomRegisterService = $this->roomRegisterServiceRepository->getByAttribute(array('id_room_register'=>$req->id,'del_flg'=>0));
        foreach ($roomRegisterService as $key  => $item){
            $roomRegisterService[$key]->serviceName = $item->serviceInstance['serviceName'];
            $roomRegisterService[$key]->servicePrice = $item->serviceInstance['servicePrice'];
        }
        $data = [
            'roomRegister'         => $this->roomRegisterRepository->getDetailInfoRoomRegister($req->id),
            'roomRegisterService'  => $roomRegisterService,
            'roomRegisterCustomer' => $this->roomRegisterCustomerRepository->getByAttribute(array('id_room_register'=>$req->id,'del_flg'=>0))
        ];
        //var_dump(($data['roomRegisterService']));die('3');
//        foreach ($data['roomRegisterService'] as $item){
//            var_dump($item->serviceName);die('3');
//        }
        return response()->json([
           'status' => 200,
           'result' => $data
        ]);
    }

    public function deleteRoomRegisterCustomer(Request $req)
    {
        $this->roomRegisterCustomerRepository->create($req->all());
        return response()->json([
            'status' => 200,
            'result' => 'success'
        ]);
    }

    public function deleteRoomRegisterService(Request $req)
    {
        $this->roomRegisterServiceRepository->create($req->all());
        return response()->json([
            'status' => 200,
            'result' => 'success'
        ]);
    }
}
