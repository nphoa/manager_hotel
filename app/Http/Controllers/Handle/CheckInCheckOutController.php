<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CustomerRepository;
use App\Repositories\Eloquents\InvoiceRepository;
use App\Repositories\Eloquents\RoomPriceRepository;
use App\Repositories\Eloquents\RoomRegisterCustomerRepository;
use App\Repositories\Eloquents\RoomRegisterRepository;
use App\Repositories\Eloquents\RoomRegisterServiceRepository;
use App\Repositories\Eloquents\RoomRepository;
use App\Repositories\Eloquents\ServiceRepository;
use Carbon\Carbon;
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
    protected $invoiceRepository;
    public function __construct(
        RoomRepository $roomRepository,
        RoomRegisterRepository $roomRegisterRepository,
        ServiceRepository $serviceRepository,
        RoomRegisterServiceRepository $roomRegisterServiceRepository,
        CustomerRepository $customerRepository,
        RoomRegisterCustomerRepository $roomRegisterCustomerRepository,
        RoomPriceRepository $roomPriceRepository,
        InvoiceRepository $invoiceRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->roomRegisterRepository = $roomRegisterRepository;
        $this->serviceRepository = $serviceRepository;
        $this->roomRegisterServiceRepository = $roomRegisterServiceRepository;
        $this->customerRepository = $customerRepository;
        $this->roomRegisterCustomerRepository = $roomRegisterCustomerRepository;
        $this->roomPriceRepository = $roomPriceRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function index(Request $req)
    {
        //var_dump($this->roomRegisterRepository->getAll1($req));die('5');
        $dataView = [
            'rooms'         => $this->roomRegisterRepository->getAll1($req),
            'services'      => $this->serviceRepository->getAll(),
            'customers'     => $this->customerRepository->getAll(),
            'roomPrice'     => $this->roomPriceRepository->getAll(),
            'currentTime'   => Carbon::now()->hour . ':' . Carbon::now()->minute,
            'currentDate'   =>  Carbon::now()->toDateString()
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }


    public function handle(Request $req){
        $data = $req->all();
        //var_dump(json_decode(($req->get('services')))  );die('3');
        //var_dump(json_decode($data['customers']));die('3');
        //var_dump($data);die('3');

        $data_response = DB::transaction(function () use ($data) {
            if($data['mode'] == 'checkIn' || $data['mode'] == 'update'){
                //insert table room_register and get id
                //room price invoice
                 if($data['id_room_price'] == '1'){
                     $data['currentTime'] = '00:00';
                     $data['toTime'] = '00:00';
                 }
                $data['date_check_in'] = Carbon::create($data['date_check_in'].' '.$data['currentTime']);
                $data['date_check_out'] = Carbon::create($data['date_check_out'].' '.$data['toTime']);
                $room_Price = $this->roomPriceRepository->getById($data['id_room_price']);
                if($data['id_room_price'] == '1'){
                    $countDate = $data['date_check_in']->diffInDays($data['date_check_out']);
                    $data['room_price_invoice'] = $room_Price->price * $countDate;
                }else{
                    $countTime = $data['date_check_in']->diffInHours($data['date_check_out']);
                    $data['room_price_invoice'] = $room_Price->price * $countTime;
                }
                $data['date_check_in'] = $data['date_check_in']->toDateTimeString();
                $data['date_check_out'] = $data['date_check_out']->toDateTimeString();

                $data['RoomRegister'] = ($this->roomRegisterRepository->create($data))->toArray();

                //insert table room_register_services
                $dataRoomRegisterService = json_decode( $data['services']);
                $service_invoice = 0;
                foreach ($dataRoomRegisterService as $service){
                    $service->id = $service->id;
                    $service->id_room_register = $data['RoomRegister']['id'];
                    $service->price =  floatval($service->service_price) * floatval($service->count);
                    $this->roomRegisterServiceRepository->create(get_object_vars($service));
                    $service_invoice += $service->price;
                }
                //update prop service_invoice in table room_register
                $this->roomRegisterRepository->create(array('id'=>$data['RoomRegister']['id'],'service_invoice'=>$service_invoice));

                //insert table room_register_customers
                $roomRegisterCustomers = json_decode( $data['customers']);
                foreach ($roomRegisterCustomers as $roomRegisterCustomer){
                    $roomRegisterCustomer = get_object_vars($roomRegisterCustomer);

                    $roomRegisterCustomer['id_room_register'] = $data['RoomRegister']['id'];
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
                return $data['RoomRegister'];
            }else{
                //Mode check out
                //Update status in table room_register
                $this->roomRegisterRepository->create(array('id'=>$data['id'],'status'=>2));
                //Insert table invoice
                $invoice = json_decode( $data['invoice'],true)[0];
                $invoice['id'] = 0;
                $invoice['id_register_room'] = $data['id'];
                $invoice['code'] = 'Invoice ' . $data['id'];
                return $this->invoiceRepository->create($invoice);
            }
        }, 5);
        return response()->json([
           'status' => 200,
           'result' => $data_response
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
            'roomRegisterCustomer' => $this->roomRegisterCustomerRepository->getByAttribute(array('id_room_register'=>$req->id,'del_flg'=>0)),

        ];

        //var_dump(($data['roomRegister']));die('3');
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
