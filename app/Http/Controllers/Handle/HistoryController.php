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

class HistoryController extends Controller
{
    protected $roomRepository;
    protected $roomRegisterRepository;

    public function __construct(
        RoomRepository $roomRepository,
        RoomRegisterRepository $roomRegisterRepository

    )
    {
        $this->roomRepository = $roomRepository;
        $this->roomRegisterRepository = $roomRegisterRepository;

    }

    public function index(Request $req)
    {
        $dataView = [
            'historyRoomRegister' => $this->roomRegisterRepository->getHistoryRoomRegister($req)
        ];
        //var_dump($dataView['historyRoomRegister'][0]);die('3');
        if($req->ajax()){

            return view('Partials.AjaxView.History_Ajax')->with('data',$dataView);
        }
        //var_dump($dataView['historyRoomRegister']);die('3');
        return view('Handle.History')->with('data',$dataView);
    }

}
