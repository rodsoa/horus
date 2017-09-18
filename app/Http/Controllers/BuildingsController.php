<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\Building;
use Horus\Models\Employee;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;
use Horus\Models\Report;

class BuildingsController extends Controller
{
   
    public function index(Request $request) {        
        // Realizando filtro
        if ($request->input('search')) {
            $buildings = Building::where('name', 'like','%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($buildings) )                       
                return view('buildings.index', [ 'buildings' => $buildings ]);
        }

        $buildings = Building::orderBy('id', 'desc')->paginate(7);
       
        return view('buildings.index', ['buildings' => $buildings]);
    }

    public function view($id) {
        
        $building  = Building::findOrFail($id);
        $employees = Employee::all(); // TODO: selecionar apenas os que tem escala para aquela unidade
        $schedules = Schedule::all();

        $days      = [1, 2, 3, 4, 5, 6, 7];

        $workschedules = WorkSchedule::where('building_id', $id)->get();
        $reports       = Report::where('building_id', $building->id)->orderBy('id', 'desc')->limit(5)->get();

        // TODO 
        return view('buildings.view', [
            'building' => $building,
            'employees' => $employees,
            'schedules' => $schedules,
            'workschedules' => $workschedules,
            'days' => $days,
            'reports' => $reports
        ]);
    }

    public function new(){       
        return view('buildings.new');
    }

    public function add(Request $request) {
        
        $building = new Building( $request->all() );

        $building->created_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');
        $building->updated_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');
        $building->status = true;

        if ( $building->save() ) {
            return redirect()->action('BuildingsController@index')->with([
                'status' => 'Unidade criada com sucesso!',
                'type' => 'success'
            ]);
        } else { 
            return redirect()->action('BuildingsController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function edit($id){    
        $building = Building::findOrFail($id);
        return view('buildings.edit', ['building' => $building]);
    }

    public function update(Request $request, $id){
        
        $building = Building::find($id);
        if ($building) {
            foreach ($request->all() as $param => $value) {
                if ($param == '_token') continue; 
                $building->$param = $value;
            }

            $building->save();

            return redirect()->action('BuildingsController@index')->with([
                'status' => 'Unidade atualizada com sucesso!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->action('BuildingsController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {
        
        $building = Building::findOrFail($id);
        // Apaga todos os registros da agenda pertencentes a essa unidade
        foreach($building->work_schedules as $ws)
            $ws->delete(); 
        $building->delete();

        return redirect()->action('BuildingsController@index')->with([
            'status' => 'Unidade apagada com sucesso.',
            'type' => 'success'
        ]);
    }

    public function toggleStatus($id) {
        
        // Verificando se existe
        $building = Building::findOrFail($id);
        if( !$building ) {
            return redirect()->action('BuildingsController@index')->with([
                'status' => 'Unidade sem registro no banco de dados!',
                'type' => 'error'
            ]);
        } else {
            $building->status = ($building->status) ? false : true;
            $building->updated_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');

            if ( $building->save() ){
                return redirect()->action('BuildingsController@view', ['id' => $id])->with([
                    'status' => 'Unidade atualizada com sucesso',
                    'type' => 'success'
                ]);
            } else { 
                return redirect()->action('BuildingsController@view', ['id' => $id])->with([
                    'status' => 'Ocorreu algum erro!',
                    'type' => 'error'
                ]);
            }
        }
    }
}