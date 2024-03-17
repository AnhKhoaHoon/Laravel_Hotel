<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    //
    public function AllFrontendRoomList()
    {
        $room = Room::latest()->get();
        return view('frontend.room.all_rooms', compact('room'));
    }
    public function RoomDetailPage($id)
    {
        $room = Room::find($id);
        $img = MultiImage::where('room_id', $id)->get();
        $facility = Facility::where('room_id', $id)->get();

        $order_room = Room::where('id', '!=', $id)->orderBy('id', 'desc')
            ->limit(2)
            ->get();


        return view('frontend.room.room_detail', compact('room', 'img', 'facility','order_room'));
    }
    public function BookingSearch(Request $request){
        //! flash la bien tam, khi load lai trang se mat
        $request->flash();

        if($request->check_in == $request->check_out){
            $notification= array    (
                'message'=>'Something want to wrong',
                'alert'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate= Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
    }
}
