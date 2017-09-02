<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Horus\Http\Controllers\Controller;

use Horus\Models\Building;
use Horus\Models\Employee;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;


class WorkSchedulesController extends Controller
{

    public function new() {
        $buildings  = Building::orderBy('id','desc')->get();
        $schedules = Schedule::all();
        
        $employees = Employee::all();
        $temp = [];
        foreach($employees as $employee)
            if ($employee->status)  $temp[] = $employee;
        $employees = $temp;

        $weekdays = [
            'DOMINGO' => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA' => 3,
            'QUARTA-FEIRA' => 4,
            'QUINTA-FEIRA' => 5,
            'SEXTA-FEIRA' => 6,
            'SÁBADO' => 7 
        ];

        return view('admin.work_schedules.new', [
            'buildings' => $buildings,
            'employees' => $employees,
            'schedules' => $schedules,
            'weekdays' => $weekdays
        ]);
    }

    public function add (Request $request) {
        return $request->all();
    }

    public function newFromBuilding ($id) {
        $building  = Building::findOrFail($id);
        $schedules = Schedule::all();
        
        $employees = Employee::all();
        $temp = [];
        foreach($employees as $employee)
            if ($employee->status)  $temp[] = $employee;
        $employees = $temp;

        $weekdays = [
            'DOMINGO' => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA' => 3,
            'QUARTA-FEIRA' => 4,
            'QUINTA-FEIRA' => 5,
            'SEXTA-FEIRA' => 6,
            'SÁBADO' => 7 
        ];

        return view('admin.work_schedules.new_from_building', [
            'building' => $building,
            'employees' => $employees,
            'schedules' => $schedules,
            'weekdays' => $weekdays
        ]);
    }

    /**
     * Processar dados passados pelo Formulário
     * schedules[] -> lista
     * weekdays[]  -> lista 
     */
    public function addFromBuilding (Request $request, $id) {
        $building = Building::find($id);

        if ($building) {
            $days = $request->input('weekdays');
            $schedules = $request->input('schedules');
            $employee_id = $request->input('employee');

            // Salvando Horários dos dias da semana
            foreach ($days as $day) {
                foreach ($schedules as $schedule_id) {
                    $workingSchedule = new WorkSchedule();
                    $workingSchedule->weekday = $day;
                    $workingSchedule->schedule_id = $schedule_id;
                    $workingSchedule->building_id = $building->id;
                    $workingSchedule->employee_id = $employee_id;
                    $workingSchedule->save();
                } 
            }

            return redirect()->action('Admin\BuildingsController@index')->with([
                'status' => 'Escala cadastrada com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\BuildingsController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function editFromBuilding($id) {}
}
