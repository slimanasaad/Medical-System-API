<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RecordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace'=>'Api'],function(){
    Route::post('register_admin',[AdminController::class,'register_admin']);
    Route::post('login_admin',[AdminController::class,'login_admin']);
    ///add record
    Route::post('add_record',[AdminController::class,'add_record']);
    ///delete record
    Route::post('delete_record',[AdminController::class,'delete_record']);
    ///update record
    Route::post('update_record',[AdminController::class,'update_record']);
    });
    
Route::group(['namespace'=>'Api'],function(){
        Route::post('register_doctor',[DoctorController::class,'register_doctor']);
        Route::post('login_doctor',[DoctorController::class,'login_doctor']);
        
        //update diagnosis
        Route::post('update_diagnosis',[DoctorController::class,'update_diagnosis']);
        
        //update drugs
        Route::post('update_drugs',[DoctorController::class,'update_drugs']);
    });
Route::group(['namespace'=>'Api'],function(){
        Route::post('register_patient',[PatientController::class,'register_patient']);
        Route::post('login_patient',[PatientController::class,'login_patient']);
        /// show all patient
        Route::get('show_patient',[PatientController::class,'show_patient']);
        
    });
    
Route::group(['namespace'=>'Api'],function(){
        Route::get('show_record',[RecordController::class,'show_record']);
        Route::post('show_record_by_id',[RecordController::class,'show_record_by_id']);
        
        
    });