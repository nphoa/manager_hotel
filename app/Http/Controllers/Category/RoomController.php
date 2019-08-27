<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getPagination(Request $req){
        $rooms = $this->roomRepository->getPagination(3);
        var_dump($rooms[0]->typeName);
        die('2');
        if($req->ajax()){
            return view('Partials.AjaxView.Room_Ajax', ['rooms'=>$rooms]);
        }
        return view('Categories.Room',['rooms'=>$rooms]);
    }

    public function create(Request $req){
        //Check mode if not delete is check validate
        if($req->get('del_flg') == 0){
            $ruleUnique = ($req->get('id') == 0) ? 'unique:rooms' : '';
            $req->validate([
                'room_code'   => 'required|'. $ruleUnique,
                'room_number' => 'required'
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
