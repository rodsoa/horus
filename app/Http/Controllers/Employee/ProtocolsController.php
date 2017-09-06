<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\Protocol;
use Horus\Models\Employee;
use Horus\Models\Building;

class ProtocolsController extends Controller
{
    public function receivingKey($employee_id, $building_id) {
        $protocol = new Protocol();
        $employee = Employee::findOrFail($employee_id);
        $building = Building::findOrFail($building_id);

        $protocol->employee_id = $employee->id;
        $protocol->building_id = $building->id;
        $protocol->category = 'R';

        $protocol->save();

        return redirect()->action('Employee\EmployeeController@index')->with([
            'status' => 'Chaves recebidas'
        ]);
    }

    public function deliveringKey($employee_id, $building_id) {
        $protocol = new Protocol();
        $employee = Employee::findOrFail($employee_id);
        $building = Building::findOrFail($building_id);

        $protocol->employee_id = $employee->id;
        $protocol->building_id = $building->id;
        $protocol->category = 'E';

        $protocol->save();

        return redirect()->action('Employee\EmployeeController@index')->with([
            'status' => 'Chaves Entregues'
        ]);
    }
}
