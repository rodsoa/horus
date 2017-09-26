@extends('layouts.base')

@section('content')
<h3 class="card-title">Editar Empregado {{ $employee->name }} <i>#{{ $employee->registration_number }}</i></h3>

<form id="needs-validation" action="{{ action('EmployeesController@update', ['matricula' => $employee->registration_number]) }}" method="POST" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-status">Categoria</label>
            <select class="form-control" id="employee-status" name="status">
                <option value="A" @if($employee->status === 'A') selected @endif>ATIVO</option>
                <option value="I" @if($employee->status === 'I') selected @endif>INATIVO</option>
                <option value="F" @if($employee->status === 'F') selected @endif>FOLGA</option>
                <option value="At" @if($employee->status === 'At') selected @endif>ATESTADO</option>
                <option value="Fe" @if($employee->status === 'Fe') selected @endif>FÉRIAS</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-5 col-lg-5">
            <label for="name">Nome do empregado</label>
            <input type="text" class="form-control" id="name-employee" name="name" placeholder="Entre com o nome do empregado" value="{{ $employee->name}}" >
        </div>

        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-category">Categoria</label>
            <select class="form-control" id="employee-category" name="employee_category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="photo">Foto</label>
            <label class="custom-file">
                <input type="file" id="photo" class="custom-file-input form-control" name="photo" value="{{ base_path('public/upload/') . $employee->photo }}">
                <span id="photo-location" class="custom-file-control"></span>
            </label>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-5 col-lg-5">
            <label for="employee-address">Endereço</label>
            <input type="text" class="form-control" id="employee-address" name="address" placeholder="rua numero bairro" value="{{ $employee->address }}" >
        </div>
        <div class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="employee-email">Endereço de email</label>
            <input type="email" class="form-control" id="employee-email" name="email" aria-describedby="employee-email-help" placeholder="empregado@email.com" value="{{ $employee->email }}">
            <small id="employee-email-help" class="form-text text-muted">Nunca compartilhe essas informações com ninguém</small>
        </div>
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="employee-phone">Telefone Residencial</label>
            <input type="text" class="form-control" id="employee-phone" name="phone" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" value="{{ $employee->phone }}" >
        </div>
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="employee-cellphone">Telefone Celular</label>
            <input type="text" class="form-control" id="employee-cellphone" name="cell_phone" placeholder="(xx) xxxxx-xxxx" data-mask="(00) 00000-0000" value="{{ $employee->cell_phone }}" >
        </div>
    </div>
    <a class="btn btn-danger" role="button" href="{{ action('EmployeesController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Editar Informações</button>
</form>
@endsection