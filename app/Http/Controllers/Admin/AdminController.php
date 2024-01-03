<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.admin_dashboard');
    }
    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    public function AdminPasswordChange()
    {
    }
    public function AdminPasswordUpdate()
    {
    }
    public function AdminProfile()
    {
    }
    public function AdminProfileStore()
    {
    }
}
