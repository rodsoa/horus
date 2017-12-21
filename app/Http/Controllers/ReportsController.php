<?php

namespace Horus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

use Horus\Http\Controllers\Controller;

use Horus\Models\Building;
use Horus\Models\Employee;
use Horus\Models\Report;
use Horus\Models\ReportImage;
use Horus\Models\Schedule;
use Horus\Models\WorkSchedule;


class ReportsController extends Controller
{
    public function index(Request $request) {

        $reports   = Report::orderBy('id', 'desc')->get();
        
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
        $schedules = Schedule::all();
        return view('reports.new', [
            'buildings' => $buildings,
            'schedules' => $schedules    
        ]);
    }

    /*
     * TODO: SALVAR IMAGENS
     */
    public function add(Request $request) {

        $user_id         = $request->input('user_id');
        $building_id     = $request->input('building_id');
        $employee_id     = $request->input('employee_id');
        $schedule_id     = $request->input('schedule_id');
        $occurrence_date = \DateTime::createFromFormat('d/m/Y', $request->input('occurrence_date')); 
        $title           = $request->input('title');
        $description     = $request->input('description');
        
        $report = new Report();
        $report->user_id         = $user_id;
        $report->building_id     = $building_id;
        $report->employee_id     = $employee_id;
        $report->schedule_id     = $schedule_id;
        $report->occurrence_date = $occurrence_date->format('Y-m-d');
        $report->title           = $title;
        $report->description     = $description;
      
        //dd( $request->photos);

        if ($report->save()) {
            // Salvando imagens do relatorio
            if ( count($request->photos) ) {
                foreach( $request->photos as $key => $photo) {
                    if ( $photo->isValid() && ( ($photo->extension() == 'jpg') || ($photo->extension() == 'jpeg'))) {
                        $path = $photo->storeAs('images/reports', $report->building->id ."-". $key++ ."-". (new \DateTime('NOW'))->format('dmYhis') .'.' .$photo->extension(), 'upload');
                        $report_image = new ReportImage();
                        $report_image->report_id = $report->id;
                        $report_image->path = $path;
                        $report_image->save();
                    }
                }
            }

            return redirect()->action('ReportsController@index')->with([
                'status' => 'Relatório de ocorrência atualizado com sucesso!',
                'type' => 'success'
                ]);
        } else { 
            return redirect()->action('ReportsController@new')->with([
                'status' => 'Ocorreu algum erro! Tente novamente',
                'type' => 'error'
            ]);
        }
    }

    public function edit($id) {

        $buildings = Building::all();
        $report = Report::findOrFail($id);
        $schedules = Schedule::all();

        return view('reports.edit', [
            'report'    => $report,
            'buildings' => $buildings,
            'schedules' => $schedules
        ]);
    }

    // TODO: IMPLEMENTAR
    public function update(Request $request, $id) {
        $report = Report::findOrFail($id);

        $user_id         = $request->input('user_id');
        $building_id     = $request->input('building_id');
        $employee_id     = $request->input('employee_id');
        $schedule_id     = $request->input('schedule_id');
        $occurrence_date = \DateTime::createFromFormat('d/m/Y', $request->input('occurrence_date')); 
        $title           = $request->input('title');
        $description     = $request->input('description');
        
        $report->user_id         = $user_id;
        $report->building_id     = $building_id;
        $report->employee_id     = $employee_id;
        $report->schedule_id     = $schedule_id;
        $report->occurrence_date = $occurrence_date->format('Y-m-d');
        $report->title           = $title;
        $report->description     = $description;

        if ($report->save()) {
            return redirect()->action('ReportsController@index')->with([
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

        // Apagando imagens relacionadas
        foreach( $report->report_images as $img) {
            Storage::disk('upload')->delete( $img->path );
            $img->delete();
        }

        $report->delete();

        return redirect()->action('ReportsController@index')->with([
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
