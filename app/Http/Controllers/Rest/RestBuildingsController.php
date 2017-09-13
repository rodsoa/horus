<?php

namespace Horus\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Building;

class RestBuildingsController extends Controller
{
    public function getAllWorkSchedules($building_id) {
        $building = Building::where('id', $building_id)->get()->first();
        // TODO: ADICIONAR DATA NO WORKSCHEDULE
        $events = [];

        foreach ($building->work_schedules as $key => $ws) {
            $events[$key]['title'] = $ws->employee->name ;
            $events[$key]['start'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[0])[0];
            $events[$key]['end'] = $ws->date .' '. explode(" ", explode("-",$ws->schedule->time_range)[1])[1];
        }

        return $events;
    }
}
