<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\Employee;
use Horus\Models\EmployeeCategory;
use Horus\Models\EmployeeVacation;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;
use Horus\Models\Report;

class EmployeesController extends Controller
{
    
    public function index (Request $request) {
        // Realizando filtro
        if ($request->input('search')) {
            $employees = Employee::where('name', 'like','%'.$request->input('search').'%')
                                   ->orWhere('registration_number', 'like','%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($employees) )                       
                return view('employees.index', [ 'employees' => $employees ]);
        }
        
        $employees = Employee::orderBy('id', 'desc')->paginate(7);

        return view('employees.index', [ 'employees' => $employees ]);
    }

    public function view ( $registration_number ) {

        $employee = Employee::where('registration_number', $registration_number)->first();    
        $vacations = EmployeeVacation::where([['employee_id', "=", $employee->id]])->orderBy('id', 'desc')->limit(5)->get();
        $reports = Report::where([['employee_id', "=", $employee->id]])->orderBy('id', 'desc')->limit(5)->get();

        //return $employee;

        $schedules = Schedule::all();

        $days = [1, 2, 3, 4, 5, 6, 7];

        $workschedules = WorkSchedule::where('employee_id', $employee->id)->get();
        
        return view('employees.view', [
            'employee' => $employee,
            'schedules' => $schedules,
            'workschedules' => $workschedules,
            'days' => $days,
            'vacations' => $vacations,
            'reports' => $reports
        ]);
    }

    public function new () {
        $categories = EmployeeCategory::all();
        
        return view("employees.new", [
            'categories' => $categories
        ]);
    }

    public function add (Request $request) {   
        $employee = new Employee( $request->all() );

        // evita duplicidade de numero de matricula
        if( !$employee->checkRegistrationNumber() )
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Ocorreu algum erro! Matrícula já atribuida.',
                'type' => 'error'
            ]);


        $employee->created_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');
        $employee->updated_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');
        $employee->status = 'A';

        // Saving photo
        $path = null;
        if( $request->hasFile('photo') && $request->file('photo')->isValid() && ( ($request->file('photo')->extension() == 'jpg') || ($request->file('photo')->extension() == 'jpeg')) ){
            $path = $request->photo->storeAs('images/employees', $employee->registration_number . '.' .$request->photo->extension(), 'upload');
            $employee->photo = $path;
        }


        if ( $employee->save() ) {

            // Telefones
            foreach( $request->input('cell_phones') as $number ) {
                $phone = new \Horus\Models\CellPhone();
                $phone->number = $number;
                $phone->employee_id = $employee->id;
                $phone->save();
            }

            // criando usuario correpondente
            $user = new \Horus\User();
            $user->name = $employee->name;
            $user->email = $employee->email;
            $user->password = bcrypt($employee->registration_number);
            $user->category = 'Ag';
            // associando empregado ao usuario
            $user->employee_id = $employee->id;
            $user->save();

            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado criado com sucesso!',
                'type' => 'success'
                ]);
        } else { 
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
                
    }

    public function edit ( $registration_number ) {
        $employee = Employee::where('registration_number', $registration_number)->first();
        $categories = EmployeeCategory::all();

        if( !$employee ) {
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado sem registro no banco de dados!',
                'type' => 'error'
            ]);
        }

        return view('employees.edit', ['employee' => $employee, 'categories' => $categories]);
    }

    public function update (Request $request, $registration_number) {
        // Verificando se existe
        $employee = Employee::where('registration_number', $registration_number)->first();
        if( !$employee ) {
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado sem registro no banco de dados!',
                'type' => 'error'
            ]);
        }
        
        // Deletar imagem anterior e salvar nova imagem
        if ( $request->hasFile('photo') && $request->file('photo')->isValid() && ( ($request->file('photo')->extension() == 'jpg') || ($request->file('photo')->extension() == 'jpeg')) ) {
            $photo = explode('/', $employee->photo)[2];
            $photo = "images/employees/".$photo;

            if ( Storage::disk('upload')->exists($photo) ) {
                Storage::disk('upload')->delete( $employee->photo );

                // Salvando nova foto carregada
                $path = null;
                $path = $request->photo->storeAs('images/employees', $employee->registration_number . '.' .$request->photo->extension(), 'upload');
                $employee->photo = $path;
            } else {
                $path = null;
                $path = $request->photo->storeAs('images/employees', $employee->registration_number . '.' .$request->photo->extension(), 'upload');
                $employee->photo = $path;
            }
        }
        
        // Salvando todos os valores passados da maneira gambiarra que o php fornece!
        foreach($request->all() as $key => $value) {
            if ($key == '_token' || $key == 'photo') continue; 
            $employee->$key = $value;
        }

        // Setando data e hora em que empregado foi editado
        $employee->updated_at = (new \DateTime('NOW'))->format('Y-m-d h:i:s');

        if ( $employee->save() ){

            // Telefones
            foreach( $request->input('cell_phones') as $key => $value ) {
                ($employee->cell_phones)[$key]->number = $value;
                ($employee->cell_phones)[$key]->save();
            }

            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado atualizado com sucesso',
                'type' => 'success'
            ]);
        } else { 
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Ocorreu algum erro!',
                'type' => 'error'
            ]);
        }
    }

    public function delete ( $registration_number ) {
        // Verificando se existe
        $employee = Employee::where('registration_number', $registration_number)->first();
        
        if( !$employee ) {
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado sem registro no banco de dados!',
                'type' => 'error'
            ]);
        }

        // Deletando imagem correspondente
        Storage::disk('upload')->delete( $employee->photo );

        // Apaga todos os registros da agenda pertencentes a essa unidade
        foreach($employee->work_schedules as $ws)
            $ws->delete(); 

        // Apaga registro desse empregado e seu respectivo usuário
        $employee->user->delete();
        \Horus\Models\CellPhone::where('employee_id', $employee)->delete();
        $employee->delete();
          
        return redirect()->action('EmployeesController@index')->with([
            'status' => 'Empregado deletado com sucesso',
            'type' => 'success'
        ]);
    }

    public function download() {
        return response()->download(storage_path('app/documents/') . 'ficha_frequencia.pdf');
    }

    public function changeStatus( $registration_number ) {
        // Verificando se existe
        $employee = Employee::where('registration_number', $registration_number)->first();
        if( !$employee ) {
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado sem registro no banco de dados!',
                'type' => 'error'
            ]);
        } else {
            if( $employee->status === 'A' )
                return redirect()->action('EmployeeVacationsController@newFromEmployee', ['registration_number' => $registration_number]);
                
            $vacation = EmployeeVacation::where([['employee_id', "=", $employee->id], ['status', '=', true]])->first();
            if( $vacation ) {
                $vacation->status = false;
                $vacation->employee->status = 'A';
                $vacation->employee->save();
                $vacation->save();
            }

            return redirect()->action('EmployeesController@view', ['registration_number' => $registration_number])->with([
                'status' => 'Agente Ativo',
                'type' => 'success'
            ]);
        }
    }
}
