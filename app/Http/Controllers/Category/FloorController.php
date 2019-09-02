<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\FloorRepository;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    protected $floorRepository;

    public function __construct(FloorRepository $floorRepository)
    {
        $this->floorRepository = $floorRepository;
    }

    public function getPagination(Request $req){
        $floors = $this->floorRepository->getPagination(3);
        if($req->ajax()){
            return view('Partials.AjaxView.Floor_Ajax', ['floors'=>$floors]);
        }
        return view('Categories.Floor',['floors'=>$floors]);
    }

    public function create(Request $req){
        //Check mode if not delete is check validate
        if($req->get('del_flg') == 0){
            $ruleUnique = ($req->get('id') == 0) ? 'unique:floors' : '';
            $req->validate([
                'floor_name'   => 'required|'. $ruleUnique,
                'room_number' => 'required'
            ]);
        }
        $row = $this->floorRepository->create($req->all());
        return response()->json([
            'status' => 'success',
            'data'  =>  $row
        ]);
    }
    public function getById(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'data'  =>  $this->floorRepository->getById($req->id)
        ]);
    }

    public function delete(Request $req)
    {
        $row = $this->floorRepository->create($req->all());
        var_dump($row);die('3');
    }
}
