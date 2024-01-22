<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class TeamController extends Controller
{
    // ham AllTeam de hien thi thong tin cua team(tuong ung voi ham index)
    public function AllTeam()
    {
        $dataTeam = Team::latest()->get();
        return view('backend.team.all_team', compact('dataTeam'));
    }
    public function AddTeam()
    {
        $dataTeam = Team::latest()->get();
        return view('backend.team.add_team',compact('dataTeam'));
    }
    public function StoreTeam(Request $request)
    {
        $image = $request->file('image');
        //
        $image_gen=hexdec(uniqid()) .'-'.$image->getClientOriginalExtension();
        Image::make($image)->resize(550,670)->save('upload/team_images'.$image_gen);
        $saveUrl='upload/team_images'.$image_gen;

        Team::insert([
            'name'=>$request->name,
            'position'=>$request->position,
            'link_fb'=>$request->link_fb,
            'image'=>$saveUrl,
            'created_at'=>Carbon::now(),

        ]);
        $notification =array(
            'message'=>'Team Data Insert Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.team')->with($notification);
    }
    public function EditTeam()
    {
      
    }
    public function UpdateTeam()
    {
    }
    public function DeleteTeam()
    {
    }
}
