@extends('layouts.base')

@section('content')
<h3 class="card-title">Atualizar Usuário</h3>
<form id="needs-validation" action="{{ action('Admin\UsersController@update', ['id' => $user->id]) }}" method="POST" novalidate>
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="name">Nome do usuário</label>
            <input type="text" class="form-control" id="name-user" name="name" placeholder="Digite com o nome do usuário" value="{{ $user->name }}">
            <div class="invalid-feedback">
                Por favor informe um nome para o usuário.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="name-email" name="email" placeholder="Digite com o email do usuário" value="{{ $user->email }}">
            <div class="invalid-feedback">
                Por favor informe um email para o usuário.
            </div>
        </div>
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="name">Senha</label>
            <input type="text" class="form-control" id="name-password" name="password" placeholder="Digite com a senha do usuário" required>
            <div class="invalid-feedback">
                Por favor defina uma senha para o usuário.
            </div>
        </div>
    </div>
    <a class="btn btn-danger" role="button" href="{{ action('Admin\UsersController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Atualizar usuário</button>
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