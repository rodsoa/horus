<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\EmployeeCategory;

class EmployeeCategoriesController extends Controller
{
    
    public function index () {      
        return view('admin.employee_categories.index', ['categories' => EmployeeCategory::all()]);
    }

    public function new () {       
        return view('admin.employee_categories.new');
    } 

    public function add (Request $request) {             
        $category = new EmployeeCategory( $request->all() );
        $category->status = true;
        
        if ($category->save()) {
            return redirect()->action('Admin\EmployeeCategoriesController@index')->with([
                'status' => 'Categoria adicionada com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\EmployeeCategoriesController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function edit($id) {    
        $category = EmployeeCategory::findOrFail($id);
        return view('admin.employee_categories.edit',['category' => $category]);
    }

    public function update(Request $request, $id) {       
        $category = EmployeeCategory::findOrFail($id);

        $category->name = $request->input('name');

        if ($category->save()) {
            return redirect()->action('Admin\EmployeeCategoriesController@index')->with([
                'status' => 'Categoria atualizada com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\EmployeeCategoriesController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {       
        $category = EmployeeCategory::findOrFail($id);

        if (  count($category->employees) )  {
            return response('Existem dados vinculados a esse registro', 500);
        } else {
            $category->delete();
        }
    }
}
