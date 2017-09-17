@extends('layouts.base')

@section('content')
<h3 class="card-title">Editar informações de {{ $building->name }}</h3>

<form id="needs-validation" action="{{ action('BuildingsController@update', ['id' => $building->id]) }}" method="POST">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-2 col-lg-2">
            <label for="building-status">Status</label>
            <select name="status" id="building-status" class="form-control">
                <option value=1 @if($building->status) selected @endif>Ativo</option>
                <option value=0 @if(!$building->status) selected @endif>Inativo</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="building-name">Nome</label>
            <input type="text" class="form-control" id="building-name" name="name" placeholder="Nome da Unidade" value="{{ $building->name }}" required>
        </div>
        <div class="form-group col-sm-12 col-md-8 col-lg-8">
            <label for="building-address">Endereço</label>
            <input type="text" class="form-control" id="building-address" name="address" placeholder="rua numero bairro" value="{{ $building->address }}" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12">
            <label for="building-description">Descrição</label>
            <textarea class="form-control" id="building-description" name="description" placeholder="Digite alguma descrição sobre a unidade">{{ $building->description }}</textarea>
        </div>
    </div>

    <a class="btn btn-danger" role="button" href="{{ action('BuildingsController@index') }}">Cancelar</a>
    <button type="submit" class="btn btn-success">Editar informações</button>    
</form>
@endsection