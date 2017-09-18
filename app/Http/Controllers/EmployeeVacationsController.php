<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\Employee;
use Horus\Models\EmployeeVacation;

class EmployeeVacationsController extends Controller
{
    public function newFromEmployee ($registration_number) {
         // Verificando se existe
        $employee = Employee::where('registration_number', $registration_number)->first();
        return view('employee_vacations.new_from_employee', ['employee' => $employee]);
    }

    public function addFromEmployee (Request $request, $registration_number) {
        $employee = Employee::where('registration_number', $registration_number)->first();
        if( !$employee ) {
            return redirect()->action('EmployeesController@index')->with([
                'status' => 'Empregado sem registro no banco de dados!',
                'type' => 'error'
            ]);
        } else {
            $ev = new EmployeeVacation();
            $ev->employee_id = $employee->id;
            $ev->beginning = (\DateTime::createFromFormat('d/m/Y', $request->input('beginning')))->format('Y-m-d');
            $ev->end = (\DateTime::createFromFormat('d/m/Y', $request->input('end')))->format('Y-m-d');
            $ev->status = true;
            
            if ($ev->save()) {
                return redirect()->action('EmployeesController@view', ['registration_number' => $registration_number])->with([
                    'status' => 'Agente posto em período de férias ou inativado com sucesso',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->action('EmployeesController@index')->with([
                    'status' => 'Ocorreu algum erro',
                    'type' => 'error'
                ]);
            }
        }
    }
}
