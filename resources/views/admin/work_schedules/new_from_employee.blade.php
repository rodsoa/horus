@extends('layouts.base')

@section('content')

@if( session('errors') )
    @foreach( session('errors') as $error )
        <div class="alert alert-danger text-center" role="alert">
            <strong>{{ $error }}</strong>
        </div>
    @endforeach
@endif

<h3 class="card-title">Criar escala de <i>{{ $employee->name }}</i></h3>

<form action="{{ action('Admin\WorkSchedulesController@addFromEmployee', ['id' => $employee->id]) }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="workschedule-building" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Unidade</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-building" name="building" required>
                <option value=""></option>
                @foreach($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Horários</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <select class="form-control" id="workschedule-schedules" name="schedules[]" required>
                <option value=""></option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->time_range }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Dias escalados</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-dates" name="dates[]" data-role="tagsinput" multiple required>      
            </select>

            <div id="datepicker" style="margin-top: 10px"></div>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="{{ action('Admin\EmployeesController@view', ['registration_number' => $employee->registration_number]) }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/tagsinput.js') }}"></script>

<script>
$('#datepicker').datepicker({
   dateFormat: 'dd/mm/yy',
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior',

    onSelect: function(dateText, inst) {
        $('#workschedule-dates').tagsinput('add', dateText);
    }
});
</script>
@endsection