<?php

namespace Horus\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Horus\Http\Controllers\Controller;

use Horus\Models\Report;
use PDF;

class ReportsController extends Controller
{
    public function index(Request $request) {

        if ($request->input('search')) {
            $reports = Report::where([['title', 'like','%'.$request->input('search').'%']])
                                   ->orderBy('id', 'desc')->paginate(7);
            
            if ( count($reports) )                       
                return view('admin.reports.index', [ 'reports' => $reports ]);
        }

        $reports = Report::orderBy('id', 'desc')->paginate(7);
        
        return view('admin.reports.index', ['reports' => $reports]);
    }

    public function view($id) {
        $report = Report::findOrFail($id);
        return view('admin.reports.view', ['report' => $report]);
    }

    public function delete($id) {
        $report = Report::findOrFail($id);

        $report->delete();

        return redirect()->action('Admin\ReportsController@index')->with([
            'status' => 'Relatório de ocorrência deletado com sucesso!',
            'type' => 'success'
            ]);
    }

    /* Função para gerar PDF e disponibilizá-lo para download */
    public function print($report_id) {
        $report = Report::findOrFail($report_id);
        $pdf = PDF::loadView('admin.reports.pdf.report-pdf', ['report' => $report]);
        return $pdf->download('relatorio-ocorrencia.pdf');
    }
}
