<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\RoomRegisterRepository;
use App\Repositories\Eloquents\RoomRepository;
use Illuminate\Http\Request;

class CheckInCheckOutController extends Controller
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
        //var_dump($this->roomRegisterRepository->getAll1($req));die('5');
        $dataView = [
            'rooms' => $this->roomRegisterRepository->getAll1($req)
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }
}
