@extends("layouts.base")

@section("content")

<h3 class="card-title">Exibindo Agente #{{ $employee->registration_number }}</h3>
@if( !$employee->status )
    <div class="alert alert-danger text-center" role="alert">
        <strong>Agente Inativado ou em Período de Férias</strong>
    </div>
@endif

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card card-body">
            <figure class="figure">
                <img src="/upload/{{ $employee->photo }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="figure-caption text-center">*Imagem de perfil do agente</figcaption>
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

                <a role="button" class="btn btn-info btn-block" href="{{ action('EmployeesController@edit', ['registration_number' => $employee->registration_number]) }}">Atualizar Empregado</a>
                <a role="button" class="btn btn-secondary btn-block" href="{{ action('EmployeesController@index') }}">Voltar</a>
            </p>
        </div>
        <br />
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8">

        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            @if( $employee->status )
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                @if( count($employee->work_schedules) )
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-table fa-fw"></i>Gerenciar escalas
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ action('WorkSchedulesController@editFromEmployee', ['id' => $employee->id]) }}"><i class="fa fa-pencil fa-fw"></i>editar escala</a>
                            <a class="dropdown-item" href="{{ action('WorkSchedulesController@newFromEmployee', ['id' => $employee->id]) }}"><i class="fa fa-plus fa-fw"></i>adicionar escala</a>
                        </div>
                    </div>
                @else
                    <a role="button" class="btn btn-secondary" href="{{ action('WorkSchedulesController@newFromEmployee', ['id' => $employee->id]) }}">
                        <i class="fa fa-table fa-fw">&nbsp;</i>escala
                    </a>
                @endif
            </div>
            @endif

            <div class="btn-group" role="group" aria-label="Third group">
                @if($employee->status)
                    <a role="button" class="btn btn-danger" href="{{ action('EmployeesController@toggleStatus', ['registration_number' => $employee->registration_number]) }}">Inativar</a>
                @else
                    <a role="button" class="btn btn-success" href="{{ action('EmployeesController@toggleStatus', ['registration_number' => $employee->registration_number]) }}">Ativar</a>
                @endif
            </div>
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
                <table class="table table-condensed table-bordered table-hover table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="3">Ultimos relatórios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>
                                     {{ $report->title }}
                                </td>
                                <td class="text-center">{{ (\DateTime::createFromFormat('Y-m-d', $report->occurrence_date))->format('d-m-Y') }}</td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a role="button" class="btn btn-secondary" href="{{ action('ReportsController@view', ['id' => $report->id]) }}"><i class="fa fa-eye"></i></a>
                                        <a role="button" class="btn btn-warning" href="{{ action('ReportsController@generatePDF', ['id' => $report->id]) }}"><i class="fa fa-file-pdf-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br />
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <table class="table table-condensed table-bordered table-hover table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="3">Ultimos registros de férias</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacations as $vacation)
                            <tr class="@if($vacation->status) bg-danger @else bg-warning @endif">
                                <td>
                                    @if ( $vacation->status )
                                        FÉRIAS ATIVAS
                                    @else
                                        FÉRIAS INATIVAS
                                    @endif
                                </td>
                                <td class="text-center">{{ (\DateTime::createFromFormat('Y-m-d', $vacation->beginning))->format('d-m-Y') }}</td>
                                <td class="text-right">{{ (\DateTime::createFromFormat('Y-m-d', $vacation->end))->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br />
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog" aria-labelledby="calendar-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calendar-modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="calendar-modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $('#employee-calendar').fullCalendar({
        locale: 'pt-br',
        events: '/api/employees/{{ $employee->registration_number }}/get-all-workschedules',
        eventClick: function(calEvent, jsEvent, view) {
            var html = "<h5>"+ calEvent.title +"</h5>";
            html +=  '<b>Horário:</b> '+ $.fullCalendar.formatDate(calEvent.start, "HH:mm");
            //html +=  ' - ' + $.fullCalendar.formatDate(calEvent.end, "HH:mm");
            console.log(calEvent.end);
            $("#calendar-modal-body").html(html);
            $('#calendar-modal').modal('show');

        },
        dayClick: function(date, allDay, jsEvent, view) { 
            var dayDate = $.fullCalendar.formatDate( date, "Y-MM-DD");
            
            var html = "Escalas para " + $.fullCalendar.formatDate( date, "DD-MM-Y");

            $("#calendar-modal-title").html(html);

            axios.get('/api/employees/{{ $employee->id }}/'+dayDate+'/get-all-workschedules')
                 .then(function (data) {
                     var html = "";
                     events = data.data
                    console.log(events.length)
                    for (var cont = 0; cont < events.length; cont++) {
                        html += "<b>"+events[cont].title+":</b> "+events[cont].start +"<br/>";
                    }
                    $("#calendar-modal-body").html(html);
                 })
                 .catch();
            $('#calendar-modal').modal('show');
        }
    });
</script>
@endsection