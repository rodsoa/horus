@extends('layouts.base')

@section('content')

<div class="row text-center">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Empregados</h3>
                <p>
                    <h3>{{ $employees }}</h3>
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
                <a role="button" class="btn btn-sm btn-info btn-block" href="href="{{ action('Admin\ReportsController@index') }}"">Visualizar</a>
            </div>
        </div>
        <br />
    </div>
</div>
@endsection