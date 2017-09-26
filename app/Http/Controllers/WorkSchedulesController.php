<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;

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

    public function delete(Request $request, $work_schedule_id) {
        $work_schedule = WorkSchedule::findOrFail($work_schedule_id);
        $work_schedule->delete();

        if ( $request->input('employee_id') ) {
            return redirect()->action('WorkSchedulesController@editFromEmployee', ['id' => $request->input('employee_id')]);
        } else {
            return redirect()->action('WorkSchedulesController@editFromBuilding', ['id' => $request->input('building_id')]);
        }
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

        return view('work_schedules.new_from_building', [
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
        //return $request->all();
        $building = Building::find($id);

        $errors = [];

        $weekdays = [
            'Sun' => 1,
            'Mon' => 2,
            'Tue' => 3,
            'Wed' => 4,
            'Thu' => 5,
            'Fri' => 6,
            'Sat' => 7 
        ];

        if ($building) {
            $dates       = $request->input('dates');
            $schedules   = $request->input('schedules');
            $employee_id = $request->input('employee');

            // Salvando Horários dos dias da semana
            // TODO: Verificar disponibilidade do horário na semana [FEITO]
            foreach ($dates as $date) {
                foreach ($schedules as $schedule_id) {
                    $day = $weekdays[(\DateTime::createFromFormat('d/m/Y', $date))->format('D')];
                    $query = [
                        ['building_id', '=', $id],
                        ['schedule_id', '=', $schedule_id],
                        ['date', '=', (\DateTime::createFromFormat('d/m/Y', $date))->format('Y-m-d')]
                    ];

                    if ( !( count(WorkSchedule::where($query)->get()) ) ) {
                        $workingSchedule = new WorkSchedule();
                        $workingSchedule->weekday     = $day;
                        $workingSchedule->date        = (\DateTime::createFromFormat('d/m/Y', $date))->format('Y-m-d');
                        $workingSchedule->schedule_id = $schedule_id;
                        $workingSchedule->building_id = $building->id;
                        $workingSchedule->employee_id = $employee_id;
                        $workingSchedule->save();
                    } else {
                        $schedule = (Schedule::find($schedule_id))->time_range;
                        switch ($day) {
                            case 1:
                                $errors [] = "Domingo $date $schedule não disponível";
                                break;
                            case 2:
                                $errors [] = "Segunda-feira $date $schedule não disponível";
                                break;
                            case 3:
                                $errors [] = "Terça-feira $date $schedule não disponível";
                                break;
                            case 4:
                                $errors [] = "Quarta-feira $date $schedule não disponível";
                                break;
                            case 5:
                                $errors [] = "Quinta-feira $date $schedule não disponível";
                                break;
                            case 6:
                                $errors [] = "Sexta-feira $date $schedule não disponível";
                                break;
                            case 7:
                                $errors [] = "Sábado $date $schedule não disponível";
                                break;
                        }
                    }
                } 
            }

            if ( count($errors) ) {
                return redirect()->action('WorkSchedulesController@newFromBuilding', ['id' => $id])->with([
                    'errors' => $errors,
                ]);
            } else {
                return redirect()->action('BuildingsController@view', ['id' => $id])->with([
                    'status' => 'Escala cadastrada com sucesso!',
                    'type' => 'success'
                ]);
            }
        } else {
            return redirect()->action('BuildingsController@view', ['id' => $id])->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function editFromBuilding($id) {
        $building  = Building::findOrFail($id);
        $schedules = Schedule::all();

        $employees = Employee::all();
        $temp = [];
        foreach($employees as $employee)
            if ($employee->status)  $temp[] = $employee;
        $employees = $temp;
        
        $weekdays  = [
            'DOMINGO' => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA' => 3,
            'QUARTA-FEIRA' => 4,
            'QUINTA-FEIRA' => 5,
            'SEXTA-FEIRA' => 6,
            'SÁBADO' => 7 
        ];
        return view('work_schedules.edit_from_building', [
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

        return redirect()->action('BuildingsController@view', ['id' => $id]);
    }

    public function newFromEmployee($id) {
        $employee = Employee::findOrFail($id);
        $buildings  = Building::all();
        $schedules = Schedule::all();
             
        $temp = [];
        foreach($buildings as $building)
            if ($building->status)  $temp[] = $building;
        $building = $temp;

        $weekdays = [
            'DOMINGO'       => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA'   => 3,
            'QUARTA-FEIRA'  => 4,
            'QUINTA-FEIRA'  => 5,
            'SEXTA-FEIRA'   => 6,
            'SÁBADO'        => 7 
        ];

        return view('work_schedules.new_from_employee', [
            'buildings' => $building,
            'employee' => $employee,
            'schedules' => $schedules,
            'weekdays' => $weekdays
        ]);
    }

    public function addFromEmployee(Request $request, $id) {
        //return $request->all();
        $employee = Employee::find($id);

        $errors = [];

        $weekdays = [
            'Sun' => 1,
            'Mon' => 2,
            'Tue' => 3,
            'Wed' => 4,
            'Thu' => 5,
            'Fri' => 6,
            'Sat' => 7 
        ];

        if ($employee) {
            //$days        = $request->input('weekdays');
            $dates       = $request->input('dates');
            $schedules   = $request->input('schedules');
            $building_id = $request->input('building');

            // Salvando Horários dos dias da semana
            // TODO: Verificar disponibilidade do horário na semana [FEITO]
            foreach ($dates as $date) {
                foreach ($schedules as $schedule_id) {
                    $day = $weekdays[(\DateTime::createFromFormat('d/m/Y', $date))->format('D')];
                    $query = [
                        ['employee_id', '=', $id],
                        ['schedule_id', '=', $schedule_id],
                        ['date', '=', (\DateTime::createFromFormat('d/m/Y', $date))->format('Y-m-d')]
                    ];
            
                    if ( !( count(WorkSchedule::where($query)->get()) ) ) {
                        $workingSchedule = new WorkSchedule();
                        $workingSchedule->weekday     = $day;
                        $workingSchedule->date        = (\DateTime::createFromFormat('d/m/Y', $date))->format('Y-m-d');
                        $workingSchedule->schedule_id = $schedule_id;
                        $workingSchedule->building_id = $building_id;
                        $workingSchedule->employee_id = $employee->id;
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
                return redirect()->action('WorkSchedulesController@newFromEmployee', ['id' => $id])->with([
                    'errors' => $errors,
                ]);
            } else {
                return redirect()->action('EmployeesController@view', ['registration_number' => $employee->registration_number])->with([
                    'status' => 'Escala cadastrada com sucesso!',
                    'type' => 'success'
                ]);
            }
        } else {
            return redirect()->action('EmployeesController@view', ['registration_number' => $employee->registration_number])->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function editFromEmployee($id) {
        $employee  = Employee::findOrFail($id);
        $schedules = Schedule::all();
        $buildings = Building::all();
        $weekdays  = [
            'DOMINGO' => 1,
            'SEGUNDA-FEIRA' => 2,
            'TERÇA-FEIRA' => 3,
            'QUARTA-FEIRA' => 4,
            'QUINTA-FEIRA' => 5,
            'SEXTA-FEIRA' => 6,
            'SÁBADO' => 7 
        ];
        return view('work_schedules.edit_from_employee', [
            'employee'  => $employee,
            'schedules' => $schedules,
            'buildings' => $buildings,
            'weekdays'  => $weekdays
        ]);
    }
    
    /**
     * TODO : Verificar se há possibilidade de choque de horário com outro empregado
     *        caso contrário realizar permuta de de horário.
     */
    public function updateFromEmployee(Request $request, $id) {
        $employee_id       = $request->input('employee_id');
        $work_schedules_id = $request->input('work_schedules_id');
        $buildings_id      = $request->input('buildings_id');    
        $schedules_id      = $request->input('schedules_id'); 

        foreach($work_schedules_id as $key => $work_schedule_id) {
            $workSchedule = WorkSchedule::find($work_schedule_id);
            $workSchedule->building_id = $buildings_id[$key];
            $workSchedule->schedule_id = $schedules_id[$key];
            $workSchedule->save();
        }

        return redirect()->action('EmployeesController@view', ['registration_number' => (Employee::find($id))->registration_number]);
    }
}
