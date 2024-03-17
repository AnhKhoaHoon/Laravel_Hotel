<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    //
    public function AllFrontendRoomList(){
        $room = Room::latest()->get();
        return view('frontend.room.all_rooms',compact('room'));
    }
}
