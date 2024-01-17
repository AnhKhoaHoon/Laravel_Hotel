<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // ham AllTeam de hien thi thong tin cua team(tuong ung voi ham index)
    public function AllTeam()
    {
        return view('backend.team.all_team');
    }
    public function AddTeam()
    {
        return view('backend.team.add_team');
    }
    public function StoreTeam()
    {
    }
    public function EditTeam()
    {
        return view('backend.team.edit_team');
    }
    public function UpdateTeam()
    {
    }
    public function DeleteTeam()
    {
    }
}
