<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\Schedule;

class SchedulesController extends Controller
{
    
    public function index () {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        $schedules = Schedule::orderBy('id', 'desc')->get();
        return view('admin.schedules.index',['schedules' => $schedules]);
    }

    public function new () {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        return view('admin.schedules.new');
    }

    public function add (Request $request) {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        $schedule = new Schedule($request->all());

        if ( $schedule->save() ) {
            return redirect()->action('Admin\SchedulesController@index')->with([
                'status' => 'Horário criado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\SchedulesController@new')->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function edit ($id) {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', ['schedule' => $schedule]);
    }

    public function update (Request $request, $id) {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        $schedule = Schedule::findOrFail($id);

        $schedule->time_range = $request->input('time_range');
        $schedule->letter = $request->input('letter');

        if ( $schedule->save() ) {
            return redirect()->action('Admin\SchedulesController@index')->with([
                'status' => 'Horário atualizado com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('Admin\SchedulesController@edit', ['id' => $schedule->id])->with([
                'status' => 'Ocorreu algum erro. Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete ($id) {
        if ( isset( Auth::user()->employee ) ) return redirect('/empregado');

        $schedule = Schedule::findOrFail($id);

        if ( count($schedule->work_schedules) ) {
            return response('Não pode deletar esses registro', 500);
        } else {
            $schedule->delete();
            return response('Resgistro apagado com sucesso', 200);
        }
    }
}
