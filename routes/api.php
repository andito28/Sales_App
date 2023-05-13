<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ToDoController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\ReminderController;

//login & Register
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'register']);

//Check Reminder
Route::get('v1/check-reminder',[ReminderController::class,'checkReminder']);


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

    //vehicle
    Route::get('v1/get-vehicle-name',[VehicleController::class,'getVehicleName']);
    Route::get('v1/get-vehicle-brand',[VehicleController::class,'getVehicleBrand']);
    Route::get('v1/get-vehicle-type',[VehicleController::class,'getVehicleType']);
    Route::get('v1/get-vehicle-color',[VehicleController::class,'getVehicleColor']);

    //ToDo
    Route::get('v1/get-todo',[ToDoController::class,'getAllToDo']);
    Route::post('v1/create-todo',[ToDoController::class,'createToDo']);
    Route::put('v1/update-todo/{id}',[ToDoController::class,'updateToDo']);
    Route::delete('v1/delete-todo/{id}',[ToDoController::class,'destroyTodo']);

    //Agenda
    Route::get('v1/get-agenda',[AgendaController::class,'getAllAgenda']);
    Route::get('v1/get-agenda/{id}',[AgendaController::class,'GetAgenda']);
    Route::post('v1/create-agenda',[AgendaController::class,'createAgenda']);
    Route::put('v1/update-agenda/{id}',[AgendaController::class,'updateAgenda']);
    Route::delete('v1/delete-agenda/{id}',[AgendaController::class,'destroyAgenda']);

    //Agenda
    Route::get('v1/get-reminder',[ReminderController::class,'getAllReminder']);
    Route::get('v1/get-reminder/{id}',[ReminderController::class,'GetReminder']);
    Route::post('v1/create-reminder',[ReminderController::class,'createReminder']);
    Route::put('v1/update-reminder/{id}',[ReminderController::class,'updateReminder']);
    Route::delete('v1/delete-reminder/{id}',[ReminderController::class,'destroyReminder']);

});
