<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;

class RoomTypeController extends Controller
{
    public function RoomTypeList()
    {
        $roomType = RoomType::orderBy('id', 'desc')->get();
        return view('backend.all_room.room_type.view_room_type', compact('roomType'));
    }
    public function AddRoomType()
    {
        $roomType = RoomType::latest()->get();
        return view('backend.all_room.room_type.add_room_type', compact('roomType'));
    }
    public function RoomTypeStore(Request $request)
    {
        RoomType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Room Type Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('room.type.list')->with($notification);
    }
    public function EditRoomType($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('backend.all_room.room_type.edit_room_type', compact('roomType'));
    }
    public function RoomTypeUpdate(Request $request)
    {
        $id = $request->id;
        RoomType::findOrFail($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Room Type Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('room.type.list')->with($notification);
    }
    public function RoomTypeDelete($id)
    {
        RoomType::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Room Type Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
