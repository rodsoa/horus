<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Employee;
use Horus\Models\Report;
use Horus\Models\ReportImage;

class ReportsController extends Controller
{
    public function index() {
        return view('employee.reports.index');
    }

    public function view($id) {
        return view('employee.reports.view');
    }

    public function new($work_schedule_id) {
            
        return view('employee.reports.new', ['work_schedule' => WorkSchedule::findOrFail($work_schedule_id)]);
    }

    /*
     * TODO: SALVAR IMAGENS
     */
    public function add(Request $request) {
        $ws     = WorkSchedule::findOrFail($request->input('work_schedule_id'));
        $report = new Report($request->all());
        
        if ($report->save()) {
            return redirect()->action('Employee\EmployeeController@index')->with([
                'status' => 'Relatório de ocorrência criado com sucesso!',
                'type' => 'success'
                ]);
        } else { 
            return redirect()->action('Employee\ReportsController@new', ['work_schedule_id' => $ws->id])->with([
                'status' => 'Ocorreu algum erro! Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function edit($id) {
        return view('employee.reports.edit');
    }

    public function update($id) {

    }

    public function delete($id) {
        
    }

    public function print($report_id) {

    }
}
