<?php

namespace App\Http\Controllers\Category;
use App\Events\UpdateCustomer;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\CustomerRepository;
class CustomerController extends Controller
{
   protected $customerRepository;

   public function __construct(CustomerRepository $customerRepository)
   {
       $this->customerRepository = $customerRepository;
   }

    public function index(){
       $customers = $this->customerRepository->getAll();
       return view('Categories.Customer',['customers'=>$customers]);
    }

    public function getAll(){
        return response()->json([
            'status' => 'success',
            'data'   => $this->customerRepository->getAll(),
        ]);
    }

    public function create(Request $req){
        //Check mode if not delete is check validate
        if($req->get('del_flg') == 0){
            $ruleUnique = ($req->get('id') == 0) ? 'unique:customers' : '';
            $req->validate([
                'fullName'   => 'required|'. $ruleUnique,
                'phoneNumber' => 'required'
            ]);
        }
        $row = $this->customerRepository->create($req->all());
        //call event to update information table room register customers
        event(new UpdateCustomer($row));

        return response()->json([
            'status' => 'success',
            'data'  =>  $row
        ]);
    }

    public function getById(Request $req)
    {
        return response()->json([
            'status' => 'success',
            'data'  =>  $this->customerRepository->getById($req->id)
        ]);
    }
    public function getPagination(Request $req){
        $customers = $this->customerRepository->getPagination(3);

        if($req->ajax()){
            return view('Partials.AjaxView.Customer_Ajax', ['customers'=>$customers]);
        }
        return view('Categories.Customer',['customers'=>$customers]);
    }

}
