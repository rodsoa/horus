@extends('layouts.base')

@section('content')
        <center>
            <h2>RELATORIO DE OCORRÊNCIA</h2>
            <h5>Criado: {{ $report->created_at->format('d-m-y H:i') }} | Atualizado: {{ $report->updated_at->format('d-m-y H:i') }}</h5>
        </center>

        <p>
            <hr />
           <h5>Agente escalado: <i>{{ $report->employee->name }} - {{ $report->employee->registration_number }}</i> </h5>
           <h5>Tel. Fixo: <i>{{ $report->employee->phone }}</i> </h5>
           <h5>Tel. celular: <i>{{ $report->employee->cell_phone }}</i> </h5>
           <h5>Email: <i>{{ $report->employee->email }}</i> </h5>
           <hr />
           <h5>Unidade: <i>{{ $report->building->name }}</i> </h5>
           <h5>Endereço: <i>{{ $report->building->address }}</i> </h5>
           <h5>Descrição: <i>{{ $report->building->description }}</i> </h5>
           <hr />
        </p>

        <p>
            <center><h2>Ocorrência</h2></center>
            {!! $report->description !!}
            <hr />
        </p>

        <footer>
            <center>
               <p>
                     __________________________________
                    <br />
                    <span>Autor</span>
                    <br  />
                    __________________________________
                    <br />
                    <span>Diretor</span>
                    <br  />
                    __________________________________
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

<a class="btn btn-danger" role="button" href="{{ action('Admin\ReportsController@index') }}">Cancelar</a>
<a class="btn btn-primary" role="button" href="{{ action('Admin\ReportsController@print', ['id' => $report->id]) }}"><i class="fa fa-file-pdf-o fw">&nbsp;</i>Imprimir</a>
@endsection