@extends('layouts.base')

@section('content')
<h3 class="card-title">Editar escalas de <i>{{ $building->name }}</i></h3>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card card-body bg-custom-primary" style="border-bottom-left-radius:0px; border-bottom-right-radius: 0px;">    
            <nav class="nav nav-pills nav-fill" id="myTab" role="tablist">     
                @foreach($weekdays as $day => $value)
                    <a class="nav-item nav-link" id="nav-{{ $value }}-tab" data-toggle="pill" href="#nav-{{ $value }}" role="tab" aria-controls="nav-{{ $value }}" aria-expanded="true">{{ $day }}</a>
                @endforeach
            </nav>
        </div>

        <div class="tab-content" id="nav-tabContent">         
            @foreach($weekdays as $day => $value)
            <div class="tab-pane fade" id="nav-{{ $value }}" role="tabpanel" aria-labelledby="nav-{{ $value }}-tab">
                <div class="card custom card-body">     
                    <form action="{{ action('WorkSchedulesController@updateFromBuilding', ['id' => $building->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="building_id" value="{{ $building->id }}" >
                        @foreach($building->work_schedules as $workschedule)
                            @if($workschedule->weekday == $value)
                                <input type="hidden" name="work_schedules_id[]" value="{{ $workschedule->id }}" >
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <select class="form-control" id="workschedule-employee" name="employees_id[]" required>
                                                <option value=""></option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" @if($workschedule->employee_id == $employee->id) selected @endif>{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <select class="form-control" id="workschedule-schedule" name="schedules_id[]" required>
                                                <option value=""></option>
                                                @foreach($schedules as $schedule)
                                                    <option value="{{ $schedule->id }}" @if($workschedule->schedule_id == $schedule->id) selected @endif>{{ $schedule->time_range }} {{ (\DateTime::createFromFormat('Y-m-d', $workschedule->date))->format('d-m-Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <button id="delete-{{ $workschedule->id }}" type="button" class="btn bt-sm btn-block btn-danger" onclick="deleteWorkSchedule({{ $workschedule->id }})">
                                            <i class="fa fa-trash"></i> Excluir
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <br />
                        <a role="button" class="btn btn-danger" href="{{ action('BuildingsController@view', ['id' => $building->id]) }}">Cancelar</a>
                        <button type="submit" class="btn btn-success">Editar escalas</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function deleteWorkSchedule ( id ) {
        var url = '/admin/escalas' + '/' + id + '/deletar';

        if( confirm("Tem certeza em realizar essa ação ?") ) {
            // TODO: Fazer callback mais atraente para essa requisição
            axios.delete(url)
             .then( function (data) {
                 alert('Registro apagado com sucesso.');
             })
             .catch( function (error) {
                 alert('Ocorreu algum erro. Repita a operação.');
             });

            location.reload();
        }
    }
</script>
@endsection