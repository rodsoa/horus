@extends('layouts.base')

@section('content')
    <h3 class="card-title"> Edição de Horário <i>({{ $schedule->letter }}) {{ $schedule->time_range }}</i></h3>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form id="needs-validation" action="{{ action('SchedulesController@update', ['id' => $schedule->id]) }}" method="POST" novalidate>
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-1 col-lg-1">
                        <label for="schedule-letter">ID</label>
                        <input class="form-control" id="schedule-letter" name="letter" placeholder="Letra" value="{{ $schedule->letter }}">
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                        <label for="schedule-time-range">Faixa de Horário</label>
                        <input class="form-control" id="schedule-time-range" name="time_range" placeholder="01:00 - 12:50" value="{{ $schedule->time_range}}">
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>

                    <div class="form-group col-sm-12 col-md-1 col-lg-1">
                        <label for="schedule-hours">Qtd. Horas</label>
                        <input type="number" class="form-control" id="schedule-hours" name="hours" placeholder="Horas" value="{{ $schedule->hours }}">
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>
                </div>

                <a class="btn btn-danger" role="button" href="{{ action('SchedulesController@index') }}">Cancelar</a>
                <button type="submit" class="btn btn-success">Editar Horário</button>    
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    (function() {
        "use strict";
        window.addEventListener("load", function() {
            var form = document.getElementById("needs-validation");
            form.addEventListener("submit", function(event) {
            if (form.checkValidity() == false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
            }, false);
        }, false);
    }());
</script>
@endsection