<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $edit_data = Room::find($id);
        $basic_facility = Facility::where('room_id', $id)->get();
        $multi_imgs = MultiImage::where('room_id', $id)->get();
        $room_no = RoomNumber::where('rooms_id', $id)->get();
        return view('backend.all_room.rooms.edit_rooms', compact('edit_data', 'basic_facility', 'multi_imgs', 'room_no'));
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
        $room->status = 1;
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
        if ($room->save()) {
            $files = $request->multi_img;
            if (!empty($files)) {
                $subimage = MultiImage::where('room_id', $id)->get()->toArray();
                MultiImage::where('room_id', $id)->delete();
            }
            if (!empty($files)) {
                foreach ($files as $file) {
                    $imgName = date('YmdHi') . '-' . $file->getClientOriginalName();
                    $file->move('upload/room_images/multi_images/', $imgName);
                    $subimage['multi_img'] = $imgName;
                    $subimage = new MultiImage();
                    $subimage->room_id = $room->id;
                    $subimage->multi_img = $imgName;
                    $subimage->save();
                }
            }
        }
        $notification = array(
            'message' => 'Update Room Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function DeleteRoom(Request $request, $id)
    {
        $room = Room::find($id);
        RoomType::where('id', $room->room_type_id)->delete();
        MultiImage::where('room_id', $room->id)->delete();
        Facility::where('room_id', $room->id)->delete();
        RoomNumber::where('rooms_id', $room->id)->delete();
        $notification = array(
            'message' => 'Room Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function StoreRoomNumber(Request $request, $id)
    {
        $data = new RoomNumber();
        $data->rooms_id = $id;
        $data->room_type_id = $request->room_type_id;
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Add RoomNumber Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //xoa anh

    public function MultiImageDelete($id)
    {
        $delete_data = MultiImage::where('id', $id)->first();
        if ($delete_data) {
            $imgPath = $delete_data->multi_img;
            if (file_exists($imgPath)) {
                unlink($imgPath);
                echo "Image Unlinked Successfully";
            } else {
                echo "Image Unlinked Unsuccessfully";
            }
        }
        MultiImage::where('id', $id)->delete();
        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            "alert-type" => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function EditRoomNumber($id)
    {
        $edit_room_no = RoomNumber::find($id);
        return view('backend.all_room.rooms.edit_room_no', compact('edit_room_no'));
    }
    public function UpdateRoomNumber(Request $request, $id)
    {
        $data = RoomNumber::find($id);
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Edit Room Number Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function DeleteRoomNumber(Request $request, $id)
    {
        RoomNumber::find($id)->delete();
        $notification = array(
            'message' => 'Edit Room Number Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
