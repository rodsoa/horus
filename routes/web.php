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
        
        Route::get('/novo', 'EmployeesController@new');
        Route::post('/adicionar', 'EmployeesController@add');
        
        Route::get('/{matricula}/editar', 'EmployeesController@edit');
        Route::post('/{matricula}/atualizar', 'EmployeesController@update');
    
        Route::delete('/{matricula}/deletar', 'EmployeesController@delete');


        // Employee Categories
        Route::prefix('categorias')->group( function () {
            Route::get('/', 'EmployeeCategoriesController@index');

            Route::get('/nova', 'EmployeeCategoriesController@new');
            Route::post('/adicionar', 'EmployeeCategoriesController@add');

            Route::get('/{id}/editar', 'EmployeeCategoriesController@edit');
            Route::post('/{id}/atualizar', 'EmployeeCategoriesController@update');    
            
            Route::delete('/{id}/deletar', 'EmployeeCategoriesController@delete');
        });

        // ANOTHER ACTIONS
        Route::get('/{matricula}/status/alterar', 'EmployeesController@toggleStatus');
    });

    // Buildings
    Route::prefix('unidades')->group( function () {
        Route::get('/', 'BuildingsController@index');
        Route::get('/{id}/exibir', 'BuildingsController@view');

        Route::get('/nova', 'BuildingsController@new');
        Route::post('/adicionar', 'BuildingsController@add');

        Route::get('/{id}/editar', 'BuildingsController@edit');
        Route::post('/{id}/atualizar', 'BuildingsController@update');
    
        Route::delete('/{id}/deletar', 'BuildingsController@delete');

        // ANOTHER ACTIONS
        Route::get('/{id}/status/alterar', 'BuildingsController@toggleStatus');
        
    });

    // Schedules
    Route::prefix('horarios')->group( function () {
        Route::get('/', 'SchedulesController@index');

        Route::get('/{id}/exibir', 'SchedulesController@view');
        
        Route::get('/novo', 'SchedulesController@new');
        Route::post('/adicionar', 'SchedulesController@add');
        
        Route::get('/{id}/editar', 'SchedulesController@edit');
        Route::post('/{id}/atualizar', 'SchedulesController@update');
            
        Route::delete('/{id}/deletar', 'SchedulesController@delete');

    });

    // Work Schedules
    Route::prefix('escalas')->group( function () {
        Route::get('/adicionar','WorkSchedulesController@new');

        Route::delete('/{id}/deletar', 'WorkSchedulesController@delete');
        
        Route::get('/unidade/{id}/novo', 'WorkSchedulesController@newFromBuilding');
        Route::post('/unidade/{id}/adicionar', 'WorkSchedulesController@addFromBuilding');
        
        Route::get('/unidade/{id}/editar', 'WorkSchedulesController@editFromBuilding');
        Route::get('/unidade/{id}/atualizar', 'WorkSchedulesController@updateFromBuilding');


    });

});
