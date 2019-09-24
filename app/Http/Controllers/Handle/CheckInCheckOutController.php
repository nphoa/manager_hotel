<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
use App\Models\RoomRegister;
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
            'rooms'         => $this->roomRegisterRepository->getAllRoomRegister($req)
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }


    public function handle(Request $req){
        $data = $req->all();
        //var_dump(json_decode(($req->get('services')))  );die('3');
        //var_dump(json_decode($data['customers']));die('3');
        //var_dump($data);die('3');

        $data_response = DB::transaction(function () use ($data) {
            $roomRegisterModel = new RoomRegister();
            $roomRegisterModel->fill($data);

           // $mode = array_search($roomRegisterModel->status,$roomRegisterModel::status);
            //var_dump($roomRegisterModel);die('3');
            if($data['mode'] != 'CheckOut'){
                if($data['mode'] == 'CheckIn' || $data['mode'] == 'Order'){
                    //insert table room_register and get id
                    //room price invoice
                    if($roomRegisterModel->id_room_price == '1'){
                        $roomRegisterModel->fromTime = '00:00';
                        $roomRegisterModel->toTime = '00:00';
                    }else{
                        $roomRegisterModel->fromTime = $data['fromTime'];
                        $roomRegisterModel->toTime = $data['toTime'];
                    }
                    $roomRegisterModel->date_check_in = Carbon::create($roomRegisterModel->date_check_in.' '.$roomRegisterModel->fromTime);
                    $roomRegisterModel->date_check_out = Carbon::create($roomRegisterModel->date_check_out.' '.$roomRegisterModel->toTime);
                    $room_Price = $this->roomPriceRepository->getById($roomRegisterModel->id_room_price);
                    if($roomRegisterModel->id_room_price == '1'){
                        $countDate = $roomRegisterModel->date_check_in->diffInDays($roomRegisterModel->date_check_out);
                        $roomRegisterModel->room_price_invoice = $room_Price->price * $countDate;
                    }else{
                        $countTime = $roomRegisterModel->date_check_in->diffInHours($roomRegisterModel->date_check_out);
                        $roomRegisterModel->room_price_invoice = $room_Price->price * $countTime;
                    }
                    $roomRegisterModel->date_check_in = $roomRegisterModel->date_check_in->toDateTimeString();
                    $roomRegisterModel->date_check_out = $roomRegisterModel->date_check_out->toDateTimeString();
                }

                //var_dump($roomRegisterModel->toArray());die('3');
                $roomRegisterModel = $this->roomRegisterRepository->create($roomRegisterModel->toArray());

                //insert table room_register_services
                if (empty($data['services']) == false){
                    $dataRoomRegisterService = json_decode( $data['services']);
                    $service_invoice = 0;
                    foreach ($dataRoomRegisterService as $service){
                        $service->id = $service->id;
                        $service->id_room_register = $roomRegisterModel->id;
                        $service->price =  floatval($service->service_price) * floatval($service->count);
                        $this->roomRegisterServiceRepository->create(get_object_vars($service));
                        $service_invoice += $service->price;
                    }
                    //update prop service_invoice in table room_register
                    $this->roomRegisterRepository->create(array('id'=>$roomRegisterModel->id,'service_invoice'=>$service_invoice));
                }
                //insert table room_register_customers
                if (empty($data['customers']) == false){
                    $roomRegisterCustomers = json_decode( $data['customers']);
                    foreach ($roomRegisterCustomers as $roomRegisterCustomer){
                        $roomRegisterCustomer = get_object_vars($roomRegisterCustomer);

                        $roomRegisterCustomer['id_room_register'] = $roomRegisterModel->id;
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
                }
                return $roomRegisterModel;
            }else{
                //Mode check out
                //Update status in table room_register
                $this->roomRegisterRepository->create(array('id'=>$roomRegisterModel->id,'status'=>$roomRegisterModel::status[$data['mode']]));
                //Insert table invoice
                $invoice = json_decode( $data['invoice'],true)[0];
                $invoice['id'] = 0;
                $invoice['id_register_room'] = $roomRegisterModel->id;
                $invoice['code'] = 'Invoice ' . $roomRegisterModel->id;
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
        $mode = $req->mode;
        $id_room = $req->id_room;
        $id_room_register = $req->id_room_register;

        $roomRegisterModel = new RoomRegister();
        $roomRegisterModel->fill([
            'id'                =>$id_room_register,
            'id_room'           =>$id_room,
            'date_check_in'     =>Carbon::now()->toDateString(),
            'date_check_out'    =>Carbon::now()->toDateString(),
            'status'            =>($mode != 'Update') ? $roomRegisterModel::status[$mode] : $roomRegisterModel::status['CheckIn']
        ]);
        //var_dump($roomRegisterModel);die('3');
        $dataView = [
            'roomRegister'         => $roomRegisterModel,
            'roomRegisterService'  => [],
            'roomRegisterCustomer' => [],
            'invoiceService'       => 0,
            'room'                 => $this->roomRepository->getById($id_room),
            'services'             => $this->serviceRepository->getAll(),
            'customers'            => $this->customerRepository->getAll(),
            'roomPrice'            => $this->roomPriceRepository->getAll(),
            'mode'                 => $mode,
        ];
        if($id_room_register != '0'){
            $totalPriceService = 0;
            $roomRegisterService = $this->roomRegisterServiceRepository->getByAttribute(array('id_room_register'=>$id_room_register,'del_flg'=>0));
            foreach ($roomRegisterService as $key  => $item){
                $roomRegisterService[$key]->serviceName = $item->serviceInstance['serviceName'];
                $roomRegisterService[$key]->servicePrice = $item->serviceInstance['servicePrice'];
                $totalPriceService += $item->price;
            }
            $dataView['invoiceService']         = $totalPriceService;
            $dataView['roomRegister']           = $roomRegisterModel->fill($this->roomRegisterRepository->getDetailInfoRoomRegister($id_room_register));
            $dataView['roomRegisterService']    = $roomRegisterService;
            $dataView['roomRegisterCustomer']   = $this->roomRegisterCustomerRepository->getByAttribute(array('id_room_register'=>$id_room_register,'del_flg'=>0));
        }

      // var_dump($dataView);die('3');
        return response()
            ->view('Partials.AjaxView.Handle_Modal_Ajax',['data'=>$dataView],200)
            ->header('Content-Type','application/html');
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
