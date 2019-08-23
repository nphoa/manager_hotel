<?php

namespace App\Http\Controllers\Category;
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
        $row = $this->customerRepository->create($req->all());
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
}
