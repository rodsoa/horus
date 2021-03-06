<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Employees | Agentes
Route::namespace('Rest')->prefix('employees')->group(function () {
    Route::get('/{registration_number}/get-all-workschedules', 'RestEmployeesController@getAllWorkSchedules');
    Route::get('/{employee_id}/{date}/get-all-workschedules', 'RestEmployeesController@getAllWorkSchedulesByDate');
});

// Buildings | Unidades
Route::namespace('Rest')->prefix('buildings')->group(function () {
    Route::get('/{building_id}/get-all-workschedules', 'RestBuildingsController@getAllWorkSchedules');
    Route::get('/{building_id}/get-all-employees', 'RestBuildingsController@getAllEmployees');
    Route::get('/{building_id}/{date}/get-all-workschedules', 'RestBuildingsController@getAllWorkSchedulesByDate');
});
