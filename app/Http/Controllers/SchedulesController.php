<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\Schedule;

class SchedulesController extends Controller
{
    
    public function index () {
        $schedules = Schedule::orderBy('id', 'desc')->paginate(7);
        //return $schedules;
        //dd($schedules);
        return view('schedules.index',['schedules' => $schedules]);
    }

    public function new () {
        return view('schedules.new');
    }

    public function add (Request $request) {
        $schedule = new Schedule($request->all());

        if ( $schedule->save() ) {
            return redirect()->action('SchedulesController@index')->with([
                'status' => 'Horário criado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('SchedulesController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function edit ($id) {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.edit', ['schedule' => $schedule]);
    }

    public function update (Request $request, $id) {
        $schedule = Schedule::findOrFail($id);

        $schedule->time_range = $request->input('time_range');
        $schedule->hours = $request->input('hours');
        $schedule->letter = $request->input('letter');

        if ( $schedule->save() ) {
            return redirect()->action('SchedulesController@index')->with([
                'status' => 'Horário atualizado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('SchedulesController@edit', ['id' => $schedule->id])->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete ($id) {
        $schedule = Schedule::findOrFail($id);

        if ( count($schedule->work_schedules) ) {
             return redirect()->action('SchedulesController@index')->with([
                'status' => 'Existem dados vinculados a esse registro',
                'type' => 'error'
            ]);
        } else {
            $schedule->delete();
            return redirect()->action('SchedulesController@index')->with([
                'status' => 'Horário apagado com sucesso.',
                'type' => 'success'
            ]);
        }
    }
}
