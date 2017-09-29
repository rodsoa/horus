@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">Agentes</h4>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h6>Ativos: {{ $active_employees }}</h6>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h6>Inativos: {{ $inactive_employees }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/agentes">visualizar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title text-center">Unidades</h4>
                <h6>{{ $buildings }}</h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/unidades">visualizar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title text-center">Usuários</h4>
                <h6>{{ $users }}</h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/usuarios">visualizar</a>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="card">
            <div class="card-body  text-center">
                <h4 class="card-title">Relatórios</h4>
                <h6>{{ $reports }}</h6>
            </div>
        </div>
        <a role="button" class="btn btn-block btn-primary" style="margin-top: 10px; margin-bottom: 10px;" href="/relatorios">visualizar</a>
    </div>
</div>
@endsection