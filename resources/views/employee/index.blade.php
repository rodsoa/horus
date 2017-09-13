@extends('layouts.base')

@section('content')

@if( session('status') )
    <div class="alert alert-success text-center" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@endif
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card card-body">
            <figure class="figure">
                <img src="/upload/{{ $employee->photo }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="figure-caption text-center">*Imagem de perfil do empregado</figcaption>
            </figure>
            <p class="card-text">
                <table class="table table-sm table-hover table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Status: </th>
                            <td class="text-right">
                                <strong>
                                    @if( $employee->status )
                                        <i class="fa fa-check-circle-o" style="color: green;"></i> ATIVO
                                    @endif

                                    @if( !$employee->status )
                                        <i class="fa fa-times-circle-o" style="color: red;"></i> INATIVO|FÉRIAS
                                    @endif
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Nome: </th>
                            <td class="text-right">{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Matrícula: </th>
                            <td class="text-right">{{ $employee->registration_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Função: </th>
                            <td class="text-right">{{ $employee->employee_category->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email: </th>
                            <td class="text-right">{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tel. Fixo: </th>
                            <td class="text-right">{{ $employee->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Celular: </th>
                            <td class="text-right">{{ $employee->cell_phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
        <br />
    </div>

    <div class="col-sm-12 col-md-8 col-lg-8">

        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <a role="button" class="btn btn-primary" href="{{ action('Employee\ReportsController@new', ['work_schedule_id' => $employee->actual_workschedule->id]) }}">Adicionar Relatório</a>
            </div>

            @if( count($employee->actual_workschedule) )
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <a role="button" class="btn btn-secondary" href="{{ action('Employee\ProtocolsController@receivingKey', ['employee_id' => $employee->id, 'building_id' => $employee->actual_workschedule->building->id]) }}">Receber Chave</a>
            </div>     

            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <a role="button" class="btn btn-secondary" href="{{ action('Employee\ProtocolsController@deliveringKey', ['employee_id' => $employee->id, 'building_id' => $employee->actual_workschedule->building->id]) }}">Entregar Chave</a>
            </div>
            @endif
        </div>

        <table class="table table-sm table-hover" style="margin-top: 15px;">
            <thead class="bg-custom-primary">
                <tr class="text-center">
                    <th colspan="2">Agenda Eletrônica</th>
                </tr>
            </thead>
        </table>     
        <div id="employee-calendar" style="margin-bottom: 20px;"></div>
        
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <table class="table table-sm table-bordered table-responsive">
                    <thead>
                        <tr class="bg-custom-primary">
                            <th colspan="3" class="text-center">
                                Ultimos Relatórios
                            </th>
                        </tr>
                    </thread>  

                    <tbody>
                        @foreach( $reports as $report )
                            <tr>    
                                <td><a href="{{ action('Employee\ReportsController@print', ['id' => $report->id]) }}">{{ $report->title }}</a></td>
                                <td>{{ $report->building->name }}</td>
                                <td>{{ $report->created_at->format('d-m') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6">
                <table class="table table-sm table-bordered table-responsive">
                    <thead>
                        <tr class="bg-custom-primary">
                            <th colspan=3 class="text-center">
                                Ultimos Protocolos
                            </th>
                        </tr>
                    </thread>  

                    <tbody>
                        @if( $employee->protocols )
                            @foreach($protocols as $protocol)
                                @if( $protocol->category == 'R')
                                    <tr class="bg-success"  style="color:white">
                                        <td>RECEBEU</td>
                                        <td class="text-center"><i>{{ $protocol->building->name }}</i></td>
                                        <td class="text-right"><i>{{ $protocol->created_at->format('d-m H:i:s') }}</i></td>
                                    </tr>
                                @else
                                    <tr class="bg-warning">
                                        <td>ENTREGOU</td>
                                        <td class="text-center"><i>{{ $protocol->building->name }}</i></td>
                                        <td class="text-right"><i>{{ $protocol->created_at->format('d-m H:i:s') }}</i></td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="2"> SEM REGISTROS </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#employee-calendar').fullCalendar({
        locale: 'pt-br',
        events: '/api/employees/{{ $employee->registration_number }}/get-all-workschedules'
    });
</script>
@endsection