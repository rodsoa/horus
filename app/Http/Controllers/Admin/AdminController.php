<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Horus\Models\Building;
use Horus\Models\Employee;

class AdminController extends Controller
{
    public function index () {
        return view('admin.index',[
            'buildings' => count(Building::all()),
            'employees' => count(Employee::all()),
            'reports'   => 0
        ]);
    }
}
