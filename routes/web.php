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
Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
        // Employees
    Route::prefix('agentes')->middleware('auth.plantonista')->group( function ()  {
        
        // CRUD ACTIONS
        Route::get('/', 'EmployeesController@index');
        
        Route::get('/{matricula}/exibir', 'EmployeesController@view');
                
        Route::get('/novo', 'EmployeesController@new');
        Route::post('/adicionar', 'EmployeesController@add');
                
        Route::get('/{matricula}/editar', 'EmployeesController@edit');
        Route::post('/{matricula}/atualizar', 'EmployeesController@update');
            
        Route::delete('/{matricula}/deletar', 'EmployeesController@delete');
        Route::get('/download/ficha-de-frequencia', 'EmployeesController@download');
        
        
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
        Route::get('/{matricula}/status/alterar', 'EmployeesController@changeStatus');
        Route::get('/{matricula}/ferias', 'EmployeeVacationsController@newFromEmployee');
        Route::post('/{matricula}/ferias/cadastrar', 'EmployeeVacationsController@addFromEmployee');
    });
        
    // Buildings
    Route::prefix('unidades')->group( function () {
        Route::get('/', 'BuildingsController@index');
        Route::get('/{id}/exibir', 'BuildingsController@view');
        
        Route::group(['middleware' => 'auth.plantonista'],function () {
            Route::get('/nova', 'BuildingsController@new');
            Route::post('/adicionar', 'BuildingsController@add');
            
            Route::get('/{id}/editar', 'BuildingsController@edit');
            Route::post('/{id}/atualizar', 'BuildingsController@update');
                
            Route::delete('/{id}/deletar', 'BuildingsController@delete');
            
            // ANOTHER ACTIONS
            Route::get('/{id}/status/alterar', 'BuildingsController@toggleStatus');
            // ANOTHER ACTIONS
            Route::get('/{id}/download/escala-mensal', 'BuildingsController@generatePDF');
        });             
    });
        
    // Schedules
    Route::prefix('horarios')->middleware('auth.plantonista')->group( function () {
        Route::get('/', 'SchedulesController@index');
        
        Route::get('/{id}/exibir', 'SchedulesController@view');
                
        Route::get('/novo', 'SchedulesController@new');
        Route::post('/adicionar', 'SchedulesController@add');
                
        Route::get('/{id}/editar', 'SchedulesController@edit');
        Route::post('/{id}/atualizar', 'SchedulesController@update');
                    
        Route::delete('/{id}/deletar', 'SchedulesController@delete');
        
    });
        
    // Work Schedules
    Route::prefix('escalas')->middleware('auth.plantonista')->group( function () {
        Route::get('/adicionar','WorkSchedulesController@new');
        
        Route::delete('/{id}/deletar', 'WorkSchedulesController@delete');
                
        Route::get('/unidade/{id}/novo', 'WorkSchedulesController@newFromBuilding');
        Route::post('/unidade/{id}/adicionar', 'WorkSchedulesController@addFromBuilding');
                
        Route::get('/unidade/{id}/editar', 'WorkSchedulesController@editFromBuilding');
        Route::post('/unidade/{id}/atualizar', 'WorkSchedulesController@updateFromBuilding');
        
        Route::get('/empregado/{id}/novo', 'WorkSchedulesController@newFromEmployee');
        Route::post('/empregado/{id}/adicionar', 'WorkSchedulesController@addFromEmployee');
                
        Route::get('/empregado/{id}/editar', 'WorkSchedulesController@editFromEmployee');
        Route::post('/empregado/{id}/atualizar', 'WorkSchedulesController@updateFromEmployee');
    });

    // Reports
    Route::prefix('relatorios')->group( function() {
        Route::get('/', 'ReportsController@index');  
        Route::get('/novo', 'ReportsController@new');
        Route::post('/cadastrar', 'ReportsController@add');
        Route::get('/{id}/gerar-pdf', 'ReportsController@generatePDF');
        Route::get('/{id}/exibir', 'ReportsController@view');
        Route::get('/{id}/editar', 'ReportsController@edit');
        Route::post('/{id}/atualizar', 'ReportsController@update');
        Route::delete('/{id}/deletar', 'ReportsController@delete');
    });

    // Users
    // ONLY ADMIN ACCESS
    Route::prefix('usuarios')->middleware('auth.admin')->group( function () {
        Route::get('/', 'UsersController@index');
                
        Route::get('/novo', 'UsersController@new');
        Route::post('/adicionar', 'UsersController@add');
                
        Route::get('/{id}/editar', 'UsersController@edit');
        Route::post('/{id}/atualizar', 'UsersController@update');
                    
        Route::delete('/{id}/deletar', 'UsersController@delete');
    });

    Route::get('/usuarios/{id}/exibir', 'UsersController@view');
});