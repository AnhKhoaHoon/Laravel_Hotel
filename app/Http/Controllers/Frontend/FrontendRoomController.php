<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    //
    public function AllFrontendRoomList(){
        $room = Room::latest()->get();
        return view('frontend.room.all_rooms',compact('room'));
    }
    public function RoomDetailPage($id){
        $room= Room::find($id);
        $img = MultiImage::where('room_id',$id)->get();
        $facility = Facility::where('room_id',$id)->get();
        return view('frontend.room.room_detail',compact('room','img','facility'));
    }
}
