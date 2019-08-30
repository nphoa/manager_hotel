<?php

namespace App\Http\Controllers\Handle;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\RoomRepository;
use Illuminate\Http\Request;

class CheckInCheckOutController extends Controller
{
    protected $roomRepository;
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        $dataView = [
            'rooms' => $this->roomRepository->getAll()
        ];
        return view('Handle.CheckInCheckOut',['data'=>$dataView]);
    }
}
