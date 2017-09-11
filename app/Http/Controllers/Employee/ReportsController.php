<?php

namespace Horus\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

use Horus\Http\Controllers\Controller;

use Horus\Models\WorkSchedule;
use Horus\Models\Employee;
use Horus\Models\Report;
use Horus\Models\ReportImage;

class ReportsController extends Controller
{
    public function index(Request $request) {

        if ($request->input('search')) {
            $reports = Report::where([
                                        ['title', 'like','%'.$request->input('search').'%'],
                                        ['employee_id','=', Auth::user()->employee->id]
                                    ])
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($reports) )                       
                return view('employee.reports.index', [ 'reports' => $reports ]);
        }

        $reports = Report::where('employee_id', Auth::user()->employee->id)->orderBy('id', 'desc')->paginate(7);
        
        return view('employee.reports.index', ['reports' => $reports]);
    }

    public function view($id) {
        $report = Report::findOrFail($id);
        return view('employee.reports.view', ['report' => $report]);
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
        $report = Report::findOrFail($id);
        return view('employee.reports.edit', ['report' => $report]);
    }

    public function update(Request $request, $id) {
        $report = Report::findOrFail($id);
        $report->title = $request->input('title');
        $report->description = $request->input('description');
        $report->updated_at = (new \DateTime('NOW'))->format('Y-m-d H:i:s');

        if ($report->save()) {
            return redirect()->action('Employee\EmployeeController@index')->with([
                'status' => 'Relatório de ocorrência atualizado com sucesso!',
                'type' => 'success'
                ]);
        } else { 
            return redirect()->action('Employee\ReportsController@edit', ['id' => $report->id])->with([
                'status' => 'Ocorreu algum erro! Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {
        $report = Report::findOrFail($id);

        $report->delete();

        return redirect()->action('Employee\EmployeeController@index')->with([
            'status' => 'Relatório de ocorrência deletado com sucesso!',
            'type' => 'success'
            ]);
    }

    /* Função para gerar PDF e disponibilizá-lo para download */
    public function print($report_id) {
        $report = Report::findOrFail($report_id);
        $pdf = PDF::loadView('employee.reports.pdf.report-pdf', ['report' => $report]);
        return $pdf->download('relatorio-ocorrencia.pdf');
    }
}
