<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\FloorRepository;
use App\Repositories\Eloquents\RoomRepository;
use App\Repositories\Eloquents\RoomTypeRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomRepository;
    protected $floorRepository;
    protected $roomTypeRepository;
    public function __construct(
        RoomRepository $roomRepository,
        RoomTypeRepository $roomTypeRepository,
        FloorRepository $floorRepository
    )
    {
        $this->roomRepository = $roomRepository;
        $this->roomTypeRepository = $roomTypeRepository;
        $this->floorRepository = $floorRepository;
    }

    public function getPagination(Request $req){
        $rooms = $this->roomRepository->getPagination(3);
        $dataView = [
            'rooms'    => $rooms,
            'roomTypes' => $this->roomTypeRepository->getAll(),
            'floors'    => $this->floorRepository->getAll()
        ];
        if($req->ajax()){
            return view('Partials.AjaxView.Room_Ajax', $dataView);
        }
        return view('Categories.Room',$dataView);
    }

    public function AddOrModifyOrDeleteInstance(Request $req){
        //Check mode if not delete is check validate
        if($req->get('del_flg') == 0){
            $ruleUnique = ($req->get('id') == 0) ? 'unique:rooms' : '';
            $req->validate([
                'room_code'   => 'required|'. $ruleUnique,
                'number_count' => 'required'
            ]);
        }
        $row = $this->roomRepository->create($req->all());
        return response()->json([
            'status' => 'success',
            'data'  =>  $row
        ]);
    }
    public function getById(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'data'  =>  $this->roomRepository->getById($req->id)
        ]);
    }


}
