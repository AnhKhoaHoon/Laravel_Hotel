<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookAreaController extends Controller
{
    public function BookArea(){
        $dataBookArea = BookArea::find(1);
        return view('backend.book_area.book_area',compact('dataBookArea'));
    }
    public function BookAreaUpdate(Request $request){
        $id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_gen = hexdec(uniqid()) . '-' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 670)->save('upload/book_area_images/' . $image_gen);
            $saveUrl = 'upload/book_area_images/' . $image_gen;

            BookArea::findOrFail($id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url'=>$request->link_url,
                'image' => $saveUrl,
                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Book Area Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            BookArea::findOrFail($id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'link_fb' => $request->link_fb,
                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Book Area Updated Without Image Unsuccessfully',
                'alert-type' => 'danger'
            );
            return redirect()->back()->with($notification);
        }
    }
}
