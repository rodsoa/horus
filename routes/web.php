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

// Users Routes
Route::namespace('Employee')->prefix('agente')->middleware(['auth', 'auth.employee'])->group( function () {
    Route::get('/', 'EmployeeController@index');
    Route::get('/perfil', 'EmployeeController@profile');

    Route::get('/{employee_id}/{building_id}/receber-chaves', 'ProtocolsController@receivingKey');
    Route::get('/{employee_id}/{building_id}/entregar-chaves','ProtocolsController@deliveringKey');

    // Reports
    Route::prefix('relatorios')->group( function () {
        Route::get('/', 'ReportsController@index');
        Route::get('/{id}/gerar-pdf', 'ReportsController@print');
        Route::get('/{id}/exibir', 'ReportsController@view');

        Route::get('/{id}/editar', 'ReportsController@edit');
        Route::post('/{id}/atualizar', 'ReportsController@update');

        Route::get('/{work_schedule_id}/novo', 'ReportsController@new');
        Route::post('/cadastrar', 'ReportsController@add');

        Route::delete('/{id}/deletar', 'ReportsController@delete');
    });
});
/* 
 | ADMIN ROUTES 
*/
Route::namespace('Admin')->middleware(['auth', 'auth.admin'])->prefix('admin')->group( function () {

    Route::get('/', 'AdminController@index');
    // Employees
    Route::prefix('agentes')->group( function ()  {

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

        Route::get('/empregado/{id}/novo', 'WorkSchedulesController@newFromEmployee');
        Route::post('/empregado/{id}/adicionar', 'WorkSchedulesController@addFromEmployee');
        
        Route::get('/empregado/{id}/editar', 'WorkSchedulesController@editFromEmployee');
        Route::get('/empregado/{id}/atualizar', 'WorkSchedulesController@updateFromEmployee');
    });

    // Users
    Route::prefix('usuarios')->group( function () {
        Route::get('/', 'UsersController@index');

        Route::get('/{id}/exibir', 'UsersController@view');
        
        Route::get('/novo', 'UsersController@new');
        Route::post('/adicionar', 'UsersController@add');
        
        Route::get('/{id}/editar', 'UsersController@edit');
        Route::post('/{id}/atualizar', 'UsersController@update');
            
        Route::delete('/{id}/deletar', 'UsersController@delete');
    });

    Route::prefix('relatorios')->group( function() {
        Route::get('/', 'ReportsController@index');  
        Route::get('/{id}/gerar-pdf', 'ReportsController@print');
        Route::get('/{id}/exibir', 'ReportsController@view');
        Route::delete('/{id}/deletar', 'ReportsController@delete');
    });
});
