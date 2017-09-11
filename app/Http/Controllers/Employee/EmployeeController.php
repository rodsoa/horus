<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\Employee;
use Horus\Models\EmployeeCategory;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;
use Horus\Models\Protocol;
use Horus\Models\Report;

class EmployeeController extends Controller
{
    public function index (Request $request) {
        $employee = Employee::where('registration_number', $request->user()->employee->registration_number)->first();
        
        $schedules = Schedule::all();
        
        $days = [1, 2, 3, 4, 5, 6, 7];
        
        $workschedules = WorkSchedule::where('employee_id', $employee->id)->get();

        // Obtendo workschedule atual Baseada nesses tres dados
        // Construção - Empregado - Horario
        $weekday = [
            'Sun' => 1,
            'Mon' => 2,
            'Tue' => 3, 
            'Wed' => 4,
            'Thu' => 5,
            'Fri' => 6,
            'Sat' => 7
        ];

        $query = [
            'employee_id' => $employee->id,
            'weekday' => $weekday[(new \DateTime('NOW'))->format('D')]
        ];

        $employee->actual_workschedule = WorkSchedule::where($query)->get()->first();
        
        $protocols = Protocol::where('employee_id', $request->user()->employee->id)->limit(5)->orderBy('id', 'desc')->get();

        $reports   = Report::orderBy('id', 'desc')->limit(6)->get();

        return view('employee.index', [
            'employee'      => $employee,
            'schedules'     => $schedules,
            'workschedules' => $workschedules,
            'protocols'     => $protocols,
            'reports'       => $reports,    
            'days'          => $days
        ]);
    }

    public function profile() {
        return view('employee.profile');
    }
}
