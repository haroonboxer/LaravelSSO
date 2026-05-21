<?php

use App\Auth\SSOUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CheckTestController;
use App\Http\Controllers\SSOController;

use App\Http\Middleware\Localization;

Illuminate\Support\Facades\Auth::routes();

// Route::get('/', function () {
//     return redirect()->route('login');
// })->name('/');

Route::get('/sso-login', [SSOController::class, 'login']);
Route::get('/Check', [SSOUser::class, 'testsso']);

Route::get('/language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return redirect()->back();
})->name('language');


Route::middleware('auth:sso')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    # --------------------------------- Users Routes ---------------------------------
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::post('/users-store', 'store')->name('users.store');
        Route::get('/users-edit/{id?}', 'edit')->name('users.edit');
        Route::post('/users-update', 'update')->name('users.update');
        Route::get('/reset-password', 'reset_password')->name('users.reset.password');
        Route::get('/user-delete/{id}', 'destroy')->name('users.delete');
        Route::post('change-user-password', 'change_password')->name('change-user-password');
        Route::post('change-user-image', 'changeUserImage')->name('change-user-image');

        Route::get('user-roles', 'roles')->name('roles.index');
        Route::post('store-role', 'store_role')->name('role.store');
        Route::post('update_role', 'update_role')->name('role.update');
        Route::get('role-details/{type}', 'role_details')->name('role.details');

        Route::get('permission-create', 'permission_create')->name('create.permission');
        Route::get('permission-details/{type}', 'permission_details')->name('permission.details');

        Route::get('/user/deactive/{id?}', 'deactive')->name('user.deactive');
        Route::get('/user/active/{id?}', 'active')->name('user.active');
        Route::post('/user/change/password', 'changePasswordByAdmin')->name('user.changePassword');
    });
    # --------------------------------- End Users Routes ---------------------------------

    #------------------------------------- CheckTestCOntroller Routes------------------------
    Route::controller(CheckTestController::class)->group(function () {
        Route::get('checkTest', 'index')->name('checkTest');
    });
});
