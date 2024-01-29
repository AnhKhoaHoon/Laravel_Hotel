<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $edit_data = Room::find($id);
        $basic_facility = Facility::where('room_id', 'id')->get();
        $multi_imgs = MultiImage::where('room_id', 'id')->get();

        return view('backend.all_room.rooms.edit_rooms', compact('edit_data', 'basic_facility', 'multi_imgs'));
    }
    public function UpdateRoom(Request $request, $id)
    {
        $room = Room::find($id);
        $room->room_type_id = $room->room_type_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;
        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description;
        $room->discount = $request->discount;

        //Todo upload image
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('upload/room_images/' . $image_gen);
            $room['image'] = $image_gen;
        }
        $room->save();

        if ($request->facility_name == null) {
            $notification = array(
                'message' => 'Facility Unsuccessfully',
                'alert_type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            Facility::where('room_id', $id)->delete();
            $facilities = Count($request->facility_name);
            //dung vong lap for de tao nhiu facility
            for ($i = 0; $i < $facilities; $i++) {
                $f_count = new Facility();
                $f_count->room_id = $room->id;
                $f_count->facility_name = $request->facility_name[$i];
                $f_count->save();
            }
        }
    }
}
