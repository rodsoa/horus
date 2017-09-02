<?php

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

Route::get('/', function () {
    return view('welcome');
});

/* 
 | ADMIN ROUTES 
*/
Route::namespace('Admin')->prefix('admin')->group( function () {

    // Employees
    Route::prefix('empregados')->group( function ()  {

        // CRUD ACTIONS
        Route::get('/', 'EmployeesController@index');
        Route::get('/{matricula}/exibir', 'EmployeesController@view');
        
        Route::get('/cadastrar', 'EmployeesController@new');
        Route::post('/', 'EmployeesController@add');
        
        Route::get('/{matricula}/editar', 'EmployeesController@edit');
        Route::post('/{matricula}', 'EmployeesController@update');
    
        Route::delete('/{matricula}/deletar', 'EmployeesController@delete');


        // Employee Categories
        Route::prefix('categorias')->group( function () {
            Route::get('/', 'EmployeeCategoriesController@index');

            Route::get('cadastrar', 'EmployeeCategoriesController@new');
            Route::post('/', 'EmployeeCategoriesController@add');
        });

        // ANOTHER ACTIONS
        Route::get('/{matricula}/status/alterar', 'EmployeesController@toggleStatus');
    });

    // Buildings
    Route::prefix('unidades')->group( function () {
        Route::get('/', 'BuildingsController@index');
        Route::get('/{id}/exibir', 'BuildingsController@view');

        Route::get('/cadastrar', 'BuildingsController@new');
        Route::post('/', 'BuildingsController@add');

        Route::get('/{id}/editar', 'BuildingsController@edit');
        Route::post('/{id}', 'BuildingsController@update');
    
        Route::delete('/{id}/deletar', 'BuildingsController@delete');

        // ANOTHER ACTIONS
        Route::get('/{id}/status/alterar', 'BuildingsController@toggleStatus');
        
    });

    // Schedules
    Route::prefix('horarios')->group( function () {
        Route::get('/', 'SchedulesController@index');

        Route::get('/{id}/exibir', 'SchedulesController@view');
        
        Route::get('/cadastrar', 'SchedulesController@new');
        Route::post('/', 'SchedulesController@add');
        
        Route::get('/{id}/editar', 'SchedulesController@edit');
        Route::post('/{id}', 'SchedulesController@update');
            
        Route::delete('/{id}/deletar', 'SchedulesController@delete');

    });

    // Work Schedules
    Route::prefix('escalas')->group( function () {
        Route::get('/adicionar','WorkSchedulesController@new');
        
        Route::get('/unidade/{id}/adicionar', 'WorkSchedulesController@newFromBuilding');
        Route::post('/unidade/{id}/adicionar', 'WorkSchedulesController@addFromBuilding');
        
        Route::get('/unidade/{id}/gerenciar', 'WorkSchedulesController@editFromBuilding');
    });

});
