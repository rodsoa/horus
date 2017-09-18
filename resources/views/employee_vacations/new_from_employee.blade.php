@extends('layouts.base')

@section('content')
    <h3 class="card-title">Cadastro de férias para {{ $employee->name }}</h3>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form id="needs-validation" action="{{ action('EmployeeVacationsController@addFromEmployee', ['registration_number' => $employee->registration_number]) }}" method="POST" novalidate>
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                        <label for="employee-vacation-beginning">Início</label>
                        <input type="text" class="form-control" id="employee-vacation-beginning" name="beginning" placeholder="Data de ínicio" required>
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-3 col-lg-3">
                        <label for="employee-vacation-end">Início</label>
                        <input type="text" class="form-control" id="employee-vacation-end" name="end" placeholder="Data de fim" required>
                        <div class="invalid-feedback">
                            Por favor esse campo não pode ficar em branco.
                        </div>
                    </div>
                </div>

                <a class="btn btn-danger" role="button" href="{{ action('EmployeesController@view', ['registration_number' => $employee->registration_number]) }}">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>    
            </form>
        </div>
    </div>
@endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script>
    
    (function() {
        "use strict";

        $('#employee-vacation-beginning').datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior'
        });

        $('#employee-vacation-end').datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior'
        });

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