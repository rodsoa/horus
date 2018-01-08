<?php

namespace Horus\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Employee;

class RestEmployeesController extends Controller
{
    public function getAllWorkSchedules($registration_number) {
        $employee = Employee::where('registration_number', $registration_number)->get()->first();
        // TODO: ADICIONAR DATA NO WORKSCHEDULE
        $events = [];
        $cont = 0;

        foreach ($employee->work_schedules as $key => $ws) {
            $events[$cont]['title'] = $ws->building->name ;
            $events[$cont]['start'] = $ws->date .' '. explode(" ", explode("x",$ws->schedule->time_range)[0])[0];
            $events[$cont]['end'] = $ws->date .' '. explode(" ", explode("x",$ws->schedule->time_range)[1])[1];
            $cont++;
        }

        return $events;
    }

    public function getAllWorkSchedulesByDate($employee_id, $date) {
        $employee = Employee::where('id', $employee_id)->get()->first();
        // TODO: ADICIONAR DATA NO WORKSCHEDULE
        $events = [];
        $cont = 0;
        foreach ($employee->work_schedules as $key => $ws) {
            if ($ws->date == $date) {
                $events[$cont]['title'] = $ws->building->name ;
                $events[$cont]['start'] = $ws->date .' '. explode(" ", explode("x",$ws->schedule->time_range)[0])[0];
                $events[$cont]['end'] = $ws->date .' '. explode(" ", explode("x",$ws->schedule->time_range)[1])[1];
                $cont++;
            } 
        }

        return $events;
    }
}
