@extends('layouts.base')

@section('content')
<h3 class="card-title">Cadastro de Unidade</h3>

<form id="needs-validation" action="{{ action('BuildingsController@add') }}" method="POST" novalidate>
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="building-name">Nome</label>
            <input type="text" class="form-control" id="building-name" name="name" placeholder="Nome da Unidade" required>
            <div class="invalid-feedback">
                Por favor informe o nome da unidade.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-8 col-lg-8">
            <label for="building-address">Endereço</label>
            <input type="text" class="form-control" id="building-address" name="address" placeholder="rua numero bairro" required>
            <div class="invalid-feedback">
                Por favor informe o endereço da unidade.
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="building-description">Descrição</label>
            <textarea class="form-control" id="building-description" name="description" placeholder="Digite alguma descrição sobre a unidade"></textarea>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="{{ action('BuildingsController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>    
</form>
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