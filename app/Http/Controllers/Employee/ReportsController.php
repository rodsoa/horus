<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Employee;

class ReportsController extends Controller
{
    public function index() {

    }

    public function view($id) {

    }

    public function new() {
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
            'employee_id' => Auth::user()->id,
            'weekday' => $weekday[(new \DateTime('NOW'))->format('D')]
        ];

        $actual_workschedule = WorkSchedule::where($query)->get();
        if ( count($actual_workschedule) ) {
            foreach ( $actual_workschedule as $aws ) {
                $time_1 = explode(" ", explode("-", $aws->schedule->time_range)[0])[1];
                $time_2 = explode(" ", explode("-", $aws->schedule->time_range)[1])[1];
                if(((new \DateTime($time_1))->format('H:i') <= (new \DateTime('NOW'))->format('H:i'))&& ((new \DateTime($time_2))->format('H:i') >= (new \DateTime('NOW'))->format('H:i')))
                    $actual_workschedule = $aws;
            } 
        }
        
        return view('employee.reports.new', ['actual_workschedule' => $actual_workschedule]);
    }

    public function add(Request $request) {

    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function delete($id) {
        
    }
}
