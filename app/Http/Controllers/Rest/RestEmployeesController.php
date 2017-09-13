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
        return $employee->work_schedules;
    }
}
