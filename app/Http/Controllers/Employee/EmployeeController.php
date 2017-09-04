<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\Employee;
use Horus\Models\EmployeeCategory;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;

class EmployeeController extends Controller
{
    public function index (Request $request) {
        $employee = Employee::where('registration_number', $request->user()->registration_number)->first();
        
        //return $employee;
        
        $schedules = Schedule::all();
        
        $days = [1, 2, 3, 4, 5, 6, 7];
        
        $workschedules = WorkSchedule::where('employee_id', $employee->id)->get();
                
        return view('employee.index', [
            'employee' => $employee,
            'schedules' => $schedules,
            'workschedules' => $workschedules,
            'days' => $days
        ]);
    }
}
