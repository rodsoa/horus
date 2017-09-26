<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Models\Employee;
use Horus\User;
use Horus\Models\Report;
use Horus\Models\Building;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( Auth::user()->category === 'Ag') {
            return redirect()->action('EmployeesController@view', ['registration_number' => Auth::user()->employee->registration_number]);
        }

        $a_employees = Employee::where('status', true)->get();
        $i_employees = Employee::where('status', false)->get();
        $users = User::all();
        $reports = Report::all();
        $buildings = Building::all();

        return view('dashboard',[
            'active_employees' => count($a_employees),
            'inactive_employees' => count($i_employees),
            'users' => count($users),
            'reports' => count($reports),
            'buildings' => count($buildings)
        ]);
    }
}
