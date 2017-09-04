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

    }

    public function add (Request $request) {
        return $request->all();
    }

    public function delete($work_schedule_id) {
        $work_schedule = WorkSchedule::findOrFail($work_schedule_id);
        $work_schedule->delete();
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

        $errors = [];

        if ($building) {
            $days = $request->input('weekdays');
            $schedules = $request->input('schedules');
            $employee_id = $request->input('employee');

            // Salvando Horários dos dias da semana
            // TODO: Verificar disponibilidade do horário na semana [FEITO]
            foreach ($days as $day) {
                foreach ($schedules as $schedule_id) {
                    $query = [
                        ['building_id', '=', $id],
                        ['schedule_id', '=', $schedule_id],
                        ['weekday', '=', $day]
                    ];

                    if ( !( count(WorkSchedule::where($query)->get()) ) ) {
                        $workingSchedule = new WorkSchedule();
                        $workingSchedule->weekday = $day;
                        $workingSchedule->schedule_id = $schedule_id;
                        $workingSchedule->building_id = $building->id;
                        $workingSchedule->employee_id = $employee_id;
                        $workingSchedule->save();
                    } else {
                        $schedule = (Schedule::find($schedule_id))->time_range;
                        switch ($day) {
                            case 1:
                                $errors [] = "Domingo $schedule não disponível";
                                break;
                            case 2:
                                $errors [] = "Segunda-feira $schedule não disponível";
                                break;
                            case 3:
                                $errors [] = "Terça-feira $schedule não disponível";
                                break;
                            case 4:
                                $errors [] = "Quarta-feira $schedule não disponível";
                                break;
                            case 5:
                                $errors [] = "Quinta-feira $schedule não disponível";
                                break;
                            case 6:
                                $errors [] = "Sexta-feira $schedule não disponível";
                                break;
                            case 7:
                                $errors [] = "Sábado $schedule não disponível";
                                break;
                        }
                    }
                } 
            }

            if ( count($errors) ) {
                return redirect()->action('Admin\WorkSchedulesController@newFromBuilding', ['id' => $id])->with([
                    'errors' => $errors,
                ]);
            } else {
                return redirect()->action('Admin\BuildingsController@view', ['id' => $id])->with([
                    'status' => 'Escala cadastrada com sucesso!',
                    'type' => 'success'
                ]);
            }
        } else {
            return redirect()->action('Admin\BuildingsController@view', ['id' => $id])->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function editFromBuilding($id) {

        $building  = Building::findOrFail($id);
        $schedules = Schedule::all();
        $employees = Employee::all();
        $weekdays  = [
            'DOMINGO' => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA' => 3,
            'QUARTA-FEIRA' => 4,
            'QUINTA-FEIRA' => 5,
            'SEXTA-FEIRA' => 6,
            'SÁBADO' => 7 
        ];
        return view('admin.work_schedules.edit_from_building', [
            'building'  => $building,
            'schedules' => $schedules,
            'employees' => $employees,
            'weekdays'  => $weekdays
        ]);
    }
    
    /**
     * TODO : Verificar se há possibilidade de choque de horário com outro empregado
     *        caso contrário realizar permuta de de horário.
     */
    public function updateFromBuilding(Request $request, $id) {

        $building_id       = $request->input('building_id');
        $work_schedules_id = $request->input('work_schedules_id');
        $employees_id      = $request->input('employees_id');    
        $schedules_id      = $request->input('schedules_id'); 

        foreach($work_schedules_id as $key => $work_schedule_id) {
            $workSchedule = WorkSchedule::find($work_schedule_id);
            $workSchedule->employee_id = $employees_id[$key];
            $workSchedule->schedule_id = $schedules_id[$key];
            $workSchedule->save();
        }

        return redirect()->action('Admin\BuildingsController@view', ['id' => $id]);
    }
}
