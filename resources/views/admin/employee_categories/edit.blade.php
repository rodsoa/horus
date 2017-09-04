@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form id="needs-validation" action="{{ action('Admin\EmployeeCategoriesController@update', ['id' => $category->id]) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label for="building-description">Nome da Categoria</label>
                        <input class="form-control" id="category-name" name="name" placeholder="Digite o nome da categoria" value="{{ $category->name}}" required>
                    </div>
                </div>

                <a class="btn btn-danger" role="button" href="{{ action('Admin\EmployeeCategoriesController@index') }}">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>    
            </form>
        </div>
    </div>
@endsection