<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $edit_data = Room::find($id);
        $basic_facility= Facility::where('room_id','id');
        return view('backend.all_room.rooms.edit_rooms',compact('edit_data','basic_facility'));


    }
}
