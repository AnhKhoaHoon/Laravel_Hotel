<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\RoomController;

use App\Http\Controllers\Backend\BookAreaController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\FrontendRoomController;
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

    Route::controller(BookingController::class)->group(function () {
        Route::get('/checkout/', 'Checkout')->name('checkout');
    });
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
        Route::post('/update/room/{id}', 'UpdateRoom')->name('update.room');
        Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');
        Route::post('/store/room/no/{id}', 'StoreRoomNumber')->name('store.room.no');
        Route::get('/delete/room/{id}', 'DeleteRoom')->name('delete.room');

        //
        Route::get('/edit/room/no/{id}', 'EditRoomNumber')->name('edit.room.no');
        Route::post('/update/room/no/{id}', 'UpdateRoomNumber')->name('update.room.no');
        Route::get('/delete/room/no/{id}', 'DeleteRoomNumber')->name('delete.room.no');
    });
});
//Todo Frontend Room
Route::controller(FrontendRoomController::class)->group(function () {
    Route::get('/room', 'AllFrontendRoomList')->name('all.frontend.room.list');
    Route::get('/room/detail/{id}', 'RoomDetailPage')->name('room.detail');
    Route::get('/booking/search/', 'BookingSearch')->name('booking.search');
    Route::get('/search/room/detail/{id}', 'SearchRoomDetails')->name('search.room.detail');
    Route::get('/check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// Auth Middleware User must have login for access this route 
Route::middleware(['auth'])->group(function(){

    /// CHECKOUT ALL Route 
Route::controller(BookingController::class)->group(function(){

   Route::get('/checkout/', 'Checkout')->name('checkout');
    
   Route::post('/booking/store/', 'BookingStore')->name('user_booking_store');
   Route::post('/checkout/store/', 'CheckoutStore')->name('checkout.store');
});

}); // End Group Auth Middleware

  