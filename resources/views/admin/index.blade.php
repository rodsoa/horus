@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <a role="button" class="btn btn-secondary bg-custom-primary btn-block" href="">Gerenciar Escalas</a>
        <br />
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <a role="button" class="btn btn-secondary bg-custom-primary btn-block" href="">Permuta de Plantões</a>
        <br />
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4">
        <a role="button" class="btn btn-secondary bg-custom-primary btn-block" href="">Adicionar</a>
        <br />
    </div>
</div>

<div class="row text-center">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Empregados</h3>
                <p>
                    <h3>{{ $buildings }}</h3>
                </p>
                <a role="button" class="btn btn-sm btn-info btn-block" href="{{ action('Admin\EmployeesController@new') }}">Adicionar</a>
            </div>
        </div>
        <br />
    </div>  

    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Unidades</h3>
                <p>
                    <h3>{{ $buildings }}</h3>
                </p>
                <a role="button" class="btn btn-sm btn-info btn-block" href="{{ action('Admin\BuildingsController@new') }}">Adicionar</a>
            </div>
        </div>
        <br />
    </div> 

    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Relatórios</h3>
                <p>
                    <h3>{{ $reports }}</h3>
                </p>
                <button type="button" class="btn btn-sm btn-info btn-block">Adicionar</button>
            </div>
        </div>
        <br />
    </div>
</div>
@endsection