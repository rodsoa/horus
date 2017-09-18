<?php

namespace Horus\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Employee;
use Horus\Models\Building;

class RestBuildingsController extends Controller
{
    public function getAllWorkSchedules($building_id) {
        $building = Building::where('id', $building_id)->get()->first();
        // TODO: ADICIONAR DATA NO WORKSCHEDULE
        $events = [];
        $cont = 0;
        foreach ($building->work_schedules as $key => $ws) {
            $events[$cont]['title'] = $ws->employee->name ;
            $events[$cont]['start'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[0])[0];
            $events[$cont]['end'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[1])[1];
            $cont++;
        }

        return $events;
    }

    public function getAllWorkSchedulesByDate($building_id, $date) {
        $building = Building::where('id', $building_id)->get()->first();
        // TODO: ADICIONAR DATA NO WORKSCHEDULE
        $events = [];
        $cont = 0;
        foreach ($building->work_schedules as $key => $ws) {
            if ($ws->date == $date) {
                $events[$cont]['title'] = $ws->employee->name ;
                $events[$cont]['start'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[0])[0];
                $events[$cont]['end'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[1])[1];
                $cont++;
            } 
        }

        return $events;
    }

    public function getAllEmployees ($building_id) {
        $building  = Building::where('id', $building_id)->get()->first();

        $employees = [];
        $ids = [];
        
        if ( count($building->work_schedules) ) {
            // Obtem todos os ids dos empregados escalados para a unidade
            foreach ($building->work_schedules as $ws) {
                $ids[] = $ws->employee->id;
            }

            // Removendo valores duplicados
            $id = array_unique($ids);

            // Obtendo empregados sem duplicações
            $employees = Employee::find($id);
        }

        return $employees;
    }
}
