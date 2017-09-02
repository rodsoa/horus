@extends('layouts.base')

@section('content')
<h3 class="card-title">Criar escala de serviço</h3>

<form>
    <div class="form-group row">
        <label for="workschedule-employee" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Unidade</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-building" name="building" >
                <option value=""></option>
                @foreach($buildings as $building)
                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="workschedule-employee" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Empregado</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <select class="form-control" id="workschedule-employee" name="employee" >
                <option value=""></option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Horários</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <select class="form-control" id="workschedule-schedules" name="schedules" multiple>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->time_range }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-12 col-md-2 col-lg-2 col-form-label">Dias da Semana</label>
        <div class="col-sm-12 col-md-4 col-lg-4">
        <select class="form-control" id="workschedule-weekdays" name="weekdays" multiple>
                @foreach($weekdays as $day => $value)
                    <option value="{{ $value }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="{{ action('Admin\BuildingsController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection