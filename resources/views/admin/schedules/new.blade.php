@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form id="needs-validation" action="{{ action('Admin\SchedulesController@add') }}" method="POST" novalidate>
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label for="schedule-letter">Letra de identifição</label>
                        <input class="form-control" id="schedule-letter" name="letter" placeholder="Letra do alfabeto capitalizada" required>
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label for="schedule-time-range">Faixa de Horário</label>
                        <input class="form-control" id="schedule-time-range" name="time_range" placeholder="Digite a faixa de horário ex: 01:00 - 12:50" required>
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>
                </div>

                <a class="btn btn-danger" role="button" href="{{ action('Admin\SchedulesController@index') }}">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>    
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