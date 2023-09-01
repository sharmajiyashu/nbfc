<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;



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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [LoginController::class,'dashboard'])->name('dashboard');
    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
    Route::resource('enquires',EnquiryController::class);
    
    Route::get('application/{id}',function(){
        return view('application-forms.create');
    })->name('application-form');
});

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('check_login',[LoginController::class,'check_login'])->name('check_login');