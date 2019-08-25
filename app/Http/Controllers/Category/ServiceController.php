<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getPagination(Request $req){
        $services = $this->serviceRepository->getPagination(3);

        if($req->ajax()){
            return view('Partials.AjaxView.Service_Ajax', ['services'=>$services]);
        }
        return view('Categories.Service',['services'=>$services]);
    }

    public function AddOrModifyOrDeleteInstance(Request $req){
        //Check mode if not delete is check validate
        if($req->get('del_flg') == 0){
            $ruleUnique = ($req->get('id') == 0) ? 'unique:services' : '';
            $req->validate([
                'service_name'   => 'required|'. $ruleUnique,
                'service_price' => 'required'
            ]);
        }
        $row = $this->serviceRepository->create($req->all());
        return response()->json([
            'status' => 'success',
            'data'  =>  $row
        ]);
    }
    public function getById(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'data'  =>  $this->serviceRepository->getById($req->id)
        ]);
    }

    public function delete(Request $req)
    {
        $row = $this->serviceRepository->create($req->all());
        var_dump($row);die('3');
    }
}
