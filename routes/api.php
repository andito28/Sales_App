<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ToDoController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\AffiliateController;
use App\Http\Controllers\Api\SubmissionPhotoController;

//Auth
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/forget-password', [AuthController::class, 'forgetPassword']);

//Check Reminder
Route::get('v1/check-reminder',[ReminderController::class,'checkReminder']);

//Get region
Route::get('v1/get-provinces',[RegionController::class,'getProvinces']);
Route::get('v1/get-regencies',[RegionController::class,'getRegencies']);


Route::group(['middleware' => ['auth:api']], function () {
    //refresh token
    Route::get('v1/refresh-token',[AuthController::class,'refreshToken']);

    //logout
    Route::get('v1/logout',[AuthController::class,'logout']);

    //profile
    Route::get('v1/get-profile',[AuthController::class,'getProfile']);
    Route::put('v1/update-profile',[AuthController::class,'updateProfile']);

    //data origin
    Route::get('v1/get-data-origin',[ContactController::class,'getDataOrigin']);

    //contact
    Route::get('v1/get-contact',[ContactController::class,'getAllContact']);
    Route::post('v1/create-contact',[ContactController::class,'createContact']);
    Route::put('v1/update-contact/{id}',[ContactController::class,'updateContact']);
    Route::get('v1/get-status-contact',[ContactController::class,'getStatusContact']);
    Route::get('v1/get-information-contact',[ContactController::class,'getInformationContact']);
    Route::get('v1/search-contact',[ContactController::class,'SearchContact']);
    Route::delete('v1/delete-contact/{id}',[ContactController::class,'destroyContact']);

    //vehicle name
    Route::get('v1/get-vehicle-name',[VehicleController::class,'getVehicleName']);
    Route::post('v1/create-vehicle-name',[VehicleController::class,'createVehicleName']);
    Route::put('v1/update-vehicle-name/{id}',[VehicleController::class,'updateVehicleName']);
    Route::delete('v1/delete-vehicle-name/{id}',[VehicleController::class,'deleteVehicleName']);

    //vehicle brand
    Route::get('v1/get-vehicle-brand',[VehicleController::class,'getVehicleBrand']);
    Route::post('v1/create-vehicle-brand',[VehicleController::class,'createVehicleBrand']);
    Route::put('v1/update-vehicle-brand/{id}',[VehicleController::class,'updateVehicleBrand']);
    Route::delete('v1/delete-vehicle-brand/{id}',[VehicleController::class,'deleteVehicleBrand']);

    //vehicle type
    Route::get('v1/get-vehicle-type',[VehicleController::class,'getVehicleType']);
    Route::post('v1/create-vehicle-type',[VehicleController::class,'createVehicleType']);
    Route::put('v1/update-vehicle-type/{id}',[VehicleController::class,'updateVehicleType']);
    Route::delete('v1/delete-vehicle-type/{id}',[VehicleController::class,'deleteVehicleType']);

    //vehicle color
    Route::get('v1/get-vehicle-color',[VehicleController::class,'getVehicleColor']);
    Route::post('v1/create-vehicle-color',[VehicleController::class,'createVehicleColor']);
    Route::put('v1/update-vehicle-color/{id}',[VehicleController::class,'updateVehicleColor']);
    Route::delete('v1/delete-vehicle-color/{id}',[VehicleController::class,'deleteVehicleColor']);

    //Dream Vehicle
    Route::post('v1/create-dream-vehicle',[VehicleController::class,'createDreamVehicle']);
    Route::put('v1/update-dream-vehicle/{id}',[VehicleController::class,'updateDreamVehicle']);
    Route::get('v1/detail-dream-vehicle/{id}',[VehicleController::class,'detailDreamVehicle']);

    //ToDo
    Route::get('v1/get-todo',[ToDoController::class,'getAllToDo']);
    Route::post('v1/create-todo',[ToDoController::class,'createToDo']);
    Route::put('v1/update-todo/{id}',[ToDoController::class,'updateToDo']);
    Route::delete('v1/delete-todo/{id}',[ToDoController::class,'destroyTodo']);

    //Agenda
    Route::get('v1/get-agenda',[AgendaController::class,'getAllAgenda']);
    Route::get('v1/get-agenda/{id}',[AgendaController::class,'getAgenda']);
    Route::get('v1/get-upcoming-agenda',[AgendaController::class,'getUpcomingAgenda']);
    Route::post('v1/create-agenda',[AgendaController::class,'createAgenda']);
    Route::put('v1/update-agenda/{id}',[AgendaController::class,'updateAgenda']);
    Route::delete('v1/delete-agenda/{id}',[AgendaController::class,'destroyAgenda']);

    //Agenda
    Route::get('v1/get-reminder',[ReminderController::class,'getAllReminder']);
    Route::get('v1/get-reminder/{id}',[ReminderController::class,'getReminder']);
    Route::get('v1/get-upcoming-reminder',[ReminderController::class,'getUpcomingReminder']);
    Route::post('v1/create-reminder',[ReminderController::class,'createReminder']);
    Route::put('v1/update-reminder/{id}',[ReminderController::class,'updateReminder']);
    Route::delete('v1/delete-reminder/{id}',[ReminderController::class,'destroyReminder']);

    //Submission photo
    Route::post('v1/create-submission-photo',[SubmissionPhotoController::class,'createSubmissionPhoto']);
    Route::delete('v1/delete-submission-photo/{id}',[SubmissionPhotoController::class,'destroySubmissionPhoto']);

    //Affiliate
    Route::get('v1/check-affiliation-available',[AffiliateController::class,'checkAffiliationAvailable']);
    Route::get('v1/get-affiliation-by-user',[AffiliateController::class,'getAffiliationByUser']);
});
