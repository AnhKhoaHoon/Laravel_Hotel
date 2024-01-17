<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[UserController::class,'Index'])->name('Index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
Route::get('/user/logout',[UserController::class,'UserLogout'])->name('user.logout');
Route::get('/user/password/change', [UserController::class, 'UserPasswordChange'])->name('user.password.change');
Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/proflie/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

});

require __DIR__ . '/auth.php';
// Todo Route Admin Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/proflie/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/password/change', [AdminController::class, 'AdminPasswordChange'])->name('admin.password.change');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');





