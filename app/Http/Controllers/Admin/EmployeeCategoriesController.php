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
}
