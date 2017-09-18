@extends('layouts.base')

@section('content')
<center>
<h2>RELATORIO DE OCORRÊNCIA</h2>
<h6>Criado: {{ $report->created_at->format('d-m-y H:i') }} | Atualizado: {{ $report->updated_at->format('d-m-y H:i') }}</h6>
</center>

<hr />
<style>
    .report { 
        display: block;
        list-style-type: none;
        margin-top: 1em;
        margin-bottom: 1 em;
        margin-left: 0;
        margin-right: 0;
        padding-left: 0;
    }

    .img-portrait {
        list-style-type: none;
        margin-top: 1em;
        margin-bottom: 1 em;
        margin-left: 0;
        margin-right: 0;
        padding-left: 0;
    }

    .img-portrait li {
        display: inline;
        margin-right: 10px;
    }
</style>
<ul class="report">
<li><b>Coordenador:</b> {{ $report->user->name }}</li> 
</ul>

<ul class="report">
<li><b>Agente escalado:</b> {{ $report->employee->name }} - {{ $report->employee->registration_number }} </li>
<li><b>Tel. Fixo:</b> {{ $report->employee->phone }} </li>
<li><b>Tel. celular:</b> {{ $report->employee->cell_phone }} </li>
<li><b>Email:</b> {{ $report->employee->email }} </li>
</ul>

<ul class="report">
<li><b>Unidade:</b> {{ $report->building->name }} </li>
<li><b>Endereço:</b> {{ $report->building->address }} </li>
<li><b>Descrição:</b> {{ $report->building->description }} </li>
</ul>

<hr />

<p>
<center>
    <h2>Ocorrência</h2>
    <h6>Data da ocorrência: {{ (\DateTime::createFromFormat('Y-m-d', $report->occurrence_date))->format('d-m-Y') }}</h6>
</center>
{!! $report->description !!}

<p>
    <ul class="img-portrait">
        @foreach($report->report_images as $img)
            <li><img src="/upload/{{ $img->path }}" width="250px;"></li>
        @endforeach
    <ul>
</p>
<hr />
</p>

<footer>
<center>
   <p>
         _________________________________________
        <br />
        <span>Autor</span>
        <br  />
        _________________________________________
        <br />
        <span>Diretor</span>
        <br  />
        _________________________________________
        <br />
        <span>Coordenador</span>
        <br />
   </p>

    <p>
       <span>Data de impressão: <i>{{ (new \DateTime('NOW'))->format('d-m-y H:i') }}</i> </span>
       <br/>
       <span>Sistema HORUS - SAMHOST</i> </span>
    </p>
</center>
<p>
</p>
</footer>

<a class="btn btn-danger" role="button" href="{{ action('ReportsController@index') }}">Cancelar</a>
<a class="btn btn-primary" role="button" href="{{ action('ReportsController@generatePDF', ['id' => $report->id]) }}"><i class="fa fa-file-pdf-o fw">&nbsp;</i>Imprimir</a>
@endsection