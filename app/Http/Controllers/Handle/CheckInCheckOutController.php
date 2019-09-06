<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
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
    public function __construct(
        RoomRepository $roomRepository,
        RoomRegisterRepository $roomRegisterRepository,
        ServiceRepository $serviceRepository,
        RoomRegisterServiceRepository $roomRegisterServiceRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->roomRegisterRepository = $roomRegisterRepository;
        $this->serviceRepository = $serviceRepository;
        $this->roomRegisterServiceRepository = $roomRegisterServiceRepository;
    }

    public function index(Request $req)
    {
        //var_dump($this->roomRegisterRepository->getAll1($req));die('5');
        $dataView = [
            'rooms' => $this->roomRegisterRepository->getAll1($req),
            'services' => $this->serviceRepository->getAll()
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }

    public  function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
            var_dump($d);die('3');
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }
    public function handle(Request $req){
        $data = $req->all();
        //var_dump(json_decode(($req->get('services')))  );die('3');
        //var_dump($data);die('3');

        DB::transaction(function () use ($data) {
            $idRoomRegister = ($this->roomRegisterRepository->create($data))->id;
            $dataRoomRegisterService = json_decode( $data['services']);
            foreach ($dataRoomRegisterService as $service){
                $service->id = $service->id;
                $service->id_room_register = $idRoomRegister;
                $service->price =  floatval($service->service_price) * floatval($service->count);
                $service = get_object_vars($service);
                //var_dump($service);die('6');
                $this->roomRegisterServiceRepository->create($service);
            }
        }, 5);
        return response()->json([
           'status' => 200,
           'result' => 'Done'
        ]);
    }

    public function getInfoDetail(Request $req)
    {
        $roomRegisterService = $this->roomRegisterServiceRepository->getByAttribute(array('id_room_register'=>$req->id));
        foreach ($roomRegisterService as $key  => $item){
            $roomRegisterService[$key]->serviceName = $item->serviceInstance['serviceName'];
            $roomRegisterService[$key]->servicePrice = $item->serviceInstance['servicePrice'];
        }
        $data = [
            'roomRegister' => $this->roomRegisterRepository->getDetailInfoRoomRegister($req->id),
            'roomRegisterService' => $roomRegisterService
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
}
