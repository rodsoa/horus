<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

use Horus\Http\Controllers\Controller;

use Horus\Models\Building;
use Horus\Models\Employee;
use Horus\Models\Report;
use Horus\Models\ReportImage;
use Horus\Models\WorkSchedule;


class ReportsController extends Controller
{
    public function index(Request $request) {

        $reports   = Report::orderBy('id', 'desc')->paginate(7);

        if ($request->input('search')) {
            $reports = Report::where('title', 'like','%'.$request->input('search').'%')
                                   ->orderBy('id', 'desc')->paginate(7);
        }
        
        return view('reports.index', [
            'reports'   => $reports,
        ]);
    }

    public function view($id) {
        $report = Report::findOrFail($id);
        return view('reports.view', ['report' => $report]);
    }

    public function new() {
        $buildings = Building::all();    
        return view('reports.new', ['buildings' => $buildings]);
    }

    /*
     * TODO: SALVAR IMAGENS
     */
    public function add(Request $request) {
        // TODO: IMPLEMENTAR LOGICA
        return $request->all();
    }

    public function edit($id) {
        $report = Report::findOrFail($id);
        return view('reports.edit', ['report' => $report]);
    }

    public function update(Request $request, $id) {
        $report = Report::findOrFail($id);
        $report->title = $request->input('title');
        $report->description = $request->input('description');
        $report->updated_at = (new \DateTime('NOW'))->format('Y-m-d H:i:s');

        if ($report->save()) {
            return redirect()->action('EmployeeController@index')->with([
                'status' => 'Relatório de ocorrência atualizado com sucesso!',
                'type' => 'success'
                ]);
        } else { 
            return redirect()->action('ReportsController@edit', ['id' => $report->id])->with([
                'status' => 'Ocorreu algum erro! Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function delete($id) {
        $report = Report::findOrFail($id);

        $report->delete();

        return redirect()->action('EmployeeController@index')->with([
            'status' => 'Relatório de ocorrência deletado com sucesso!',
            'type' => 'success'
            ]);
    }

    /* Função para gerar PDF e disponibilizá-lo para download */
    public function generatePDF($report_id) {
        $report = Report::findOrFail($report_id);
        $pdf = PDF::loadView('reports.pdf.report-pdf', ['report' => $report]);
        return $pdf->download('relatorio-ocorrencia.pdf');
    }
}
