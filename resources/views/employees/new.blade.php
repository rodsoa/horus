@extends('layouts.base')

@section('content')
<h3 class="card-title">Cadastro de Empregado</h3>

<form id="needs-validation" action="{{ action('EmployeesController@add') }}" method="POST" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="name">Matrícula</label>
            <input type="text" class="form-control" id="registration-number-employee" name="registration_number" placeholder="Digite a matrícula" required>
            <div class="invalid-feedback">
                Por favor informe a matrícula do empregado.
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="name">Nome do empregado</label>
            <input type="text" class="form-control" id="name-employee" name="name" placeholder="Entre com o nome do empregado" required>
            <div class="invalid-feedback">
                Por favor informe nome do empregado.
            </div>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-category">Categoria</label>
            <select class="form-control" id="employee-category" name="employee_category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="photo">Foto <small><i>*jpg/jpeg</i></small></label>
            <label class="custom-file">
                <input type="file" id="photo" class="custom-file-input form-control" name="photo" required>
                <span id="photo-location" class="custom-file-control"></span>
            </label>
            <div class="invalid-feedback">
                Por favor, escolha uma imagem.
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-5 col-lg-5">
            <label for="employee-address">Endereço</label>
            <input type="text" class="form-control" id="employee-address" name="address" placeholder="rua numero bairro" required>
            <div class="invalid-feedback">
                Por favor informe endereço do empregado.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-email">Endereço de email</label>
            <input type="email" class="form-control" id="employee-email" name="email" aria-describedby="employee-email-help" placeholder="empregado@email.com">
            <small id="employee-email-help" class="form-text text-muted">Nunca compartilhe essas informações com ninguém</small>
        </div>
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="employee-phone">Telefone Residencial</label>
            <input type="text" class="form-control" id="employee-phone" name="phone" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" required>
            <div class="invalid-feedback">
                Por favor informe número de telefone fixo do empregado.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="employee-cellphone">Telefone Celular</label>
            <input type="text" class="form-control" id="employee-cellphone" name="cell_phone" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" required>
            <div class="invalid-feedback">
                Por favor informe número de celular do empregado.
            </div>
        </div>
    </div>
    <a class="btn btn-danger" role="button" href="{{ action('EmployeesController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection

@section('js')
<script src="/js/jquery.mask.min.js"></script>
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