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

        foreach ($employee->work_schedules as $key => $ws) {
            $events[$key]['title'] = $ws->building->name ;
            $events[$key]['start'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[0])[0];
            $events[$key]['end'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[1])[1];
        }

        return $events;
    }
}
