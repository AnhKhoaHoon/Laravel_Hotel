<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomBookedDate;
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


        return view('frontend.room.room_detail', compact('room', 'img', 'facility', 'order_room'));
    }
    public function BookingSearch(Request $request)
    {
        //! flash la bien tam, khi load lai trang se mat
        $request->flash();

        if ($request->check_in == $request->check_out) {
            $notification = array(
                'message' => 'Something want to wrong',
                'alert' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }
        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();
        $rooms = Room::withCount('room_numbers')->where('status', 1)->get();
        return view('frontend.room.search_rooms', compact('rooms', 'check_date_booking_ids'));
    }
    public function SearchRoomDetails(Request $request, $id)
    {
        $request->flash();
        $room_detail = Room::find($id);
        $img = MultiImage::where('room_id', $id)->get();
        $facility = Facility::where('room_id', $id)->get();
        $other_room = Room::where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();
        $room_id = $id;
        return view('frontend.room.search_room_detail', compact('room_detail', 'img', 'facility', 'other_room', 'room_id'));
    }
    public function CheckRoomAvailability(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }
        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();
        $room = Room::withCount('room_numbers')->find($request->room_id);

        $bookings = Booking::withCount('assign_rooms')
            ->whereIn('id', $check_date_booking_ids)
            ->where('rooms_id', $room->id)
            ->get()
            ->toArray();

        $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));

        $av_room = @$room->room_numbers_count - $total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffinDays($fromDate);

        return response()->json(['available_room' => $av_room, 'total_nights' => $nights]);
    }
}
