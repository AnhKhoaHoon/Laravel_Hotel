<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\RoomType;
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

Route::get('/', [UserController::class, 'Index'])->name('Index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
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

    //Todo Team Route
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'StoreTeam')->name('store.team');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/team/delete/{id}', 'DeleteTeam')->name('delete.team');
    });
    //Todo Book Area Route
    Route::controller(BookAreaController::class)->group(function () {
        Route::get('/book/area/', 'BookArea')->name('book.area');
        Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');
    });
    //Todo Room Type Route
    Route::controller(RoomTypeController::class)->group(function () {
        Route::get('/room/type/list/', 'RoomTypeList')->name('room.type.list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room.type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type.store');
        Route::get('/edit/room/type/{id}', 'EditRoomType')->name('edit.room.type');
        Route::post('/room/type/update', 'RoomTypeUpdate')->name('room.type.update');
        Route::get('/room/type/delete{id}', 'RoomTypeDelete')->name('room.type.delete');
    });
    //Todo Room Route
    Route::controller(RoomController::class)->group(function () {
        Route::get('/edit/room/{id}', 'EditRoom')->name('edit.room');
    });
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
