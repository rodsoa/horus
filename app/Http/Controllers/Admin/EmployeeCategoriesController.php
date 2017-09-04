<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;

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
    }

    public function delete($id) {
        $category = EmployeeCategory::findOrFail($id);
        $category->delete();
    }
}
