<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\CustomerRepository;
class CustomerController extends Controller
{
   protected $customerRepository;
   public function __construct(CustomerRepository $customerRepository)
   {
       $this->customerRepository = $customerRepository;
   }

    public function getAll()
    {
        $data = [
            'fullName' => 'Nguyen Phuoc Hoa',
            'birthday' => '1993-05-15',
            'address' => '155/7',
            'phoneNumber' => '1234567',
        ];
        //$data1 = $this->customerRepository->create($data);
        var_dump($data);die('2');
    }
}
