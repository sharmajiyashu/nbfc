<?php

use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\EmiController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\LoanApplicatioController;
use App\Http\Controllers\LoginController;
use App\Models\LoanApplication;
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
    Route::resource('emis',EmiController::class);
    Route::resource('application',ApplicationFormController::class);
    Route::post('change_status',[EnquiryController::class,'changeStatus'])->name('enquiries.change_status');
    Route::get('application-form/{id}',[ApplicationFormController::class,'create'])->name('application-form');
    Route::get('loan-application-approvels',[ApplicationFormController::class,'loanApplicationApprovel'])->name('loan_application_approvel');
    Route::post('application_form.approved',[ApplicationFormController::class,'approved'])->name('application_form.approved');
    Route::post('application_form.reject',[ApplicationFormController::class,'reject'])->name('application_form.reject');
    Route::get('dishbushment/{id}',[LoanApplicatioController::class,'dishbushment'])->name('dishbushment');
    Route::get('emi_collect',[LoanApplicatioController::class,'emiCollect'])->name('emi_collect');
    Route::post('pay_emi',[EmiController::class,'pay_emi'])->name('pay_emi');
});

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('check_login',[LoginController::class,'check_login'])->name('check_login');