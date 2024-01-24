<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $edit_data = Room::find($id);
        return view('backend.all_room.rooms.edit_rooms',compact('edit_data'));
    }
}
