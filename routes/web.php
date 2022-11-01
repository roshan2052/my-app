<?php

use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TestController;
use App\Http\Controllers\Backend\TestingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    return "Cache Cleared!";
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');


Route::middleware(['web','auth'])->prefix('backend/')->name('backend.')->group(function () {
    Route::get('dashboard',[HomeController::class, 'index'])->name('dashboard.index');

    // test crud
    Route::get('test/export', [TestController::class, 'export'])->name('test.export');

    Route::resource('test', TestController::class)->names('test');



    // testing
    Route::resource('testing', TestingController::class)->names('testing');
    Route::post('testing/data', [TestingController::class, 'getTestingDataForDataTable'])->name('testing.data');


});

Route::group(['prefix' => 'backend/user', 'as' => 'backend.user.', 'namespace' => 'Backend\User\\', 'middleware' => 'auth'], function () {

    Route::get('profile',[UserController::class, 'profile'])->name('profile');
    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('change_password');

});
