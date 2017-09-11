@extends('layouts.base')

@section('content')

@if( session('status') && session('type') == 'success' )
    <div class="alert alert-success text-center" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@endif

@if( session('status') && session('type') == 'error' )
    <div class="alert alert-danger text-center" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@endif

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">    
        <a role="button" class="btn btn-primary" href="{{ action('Admin\BuildingsController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i> Nova unidade
        </a>
    </div>
    
    <div class="col-sm-12 col-md-6 col-lg-6">
        <form>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-cog fa-fw"></i>
                    </button>
                </span>
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." name="search">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Pesquisar</button>
                </span>
            </div>
        </form>
    </div>
</div>

<br />

<table class="table table-sm table-hover table-responsive">
    <thead>
        <tr>
            <th>Status</th>
            <th colspan="2">Nome</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $buildings as $building )
        <tr>
            <td>
                @if( $building->status )
                    <i class="fa fa-check-circle-o" style="color: green;"></i>
                @endif

                @if( !$building->status )
                    <i class="fa fa-times-circle" style="color: red;"></i>
                @endif
            </td>
            <td>{{ $building->name }}</td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\BuildingsController@view', ['id' => $building->id ]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\BuildingsController@edit', ['id' => $building->id ]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('Admin\BuildingsController@delete', ['id' => $building->id]) }}">
                        {{ csrf_field () }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-{{ $building->id }}" type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="...">
    <ul class="pagination pagination-sm justify-content-center">      
        @if( $buildings->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ action('Admin\BuildingsController@index') }}?page={{ $buildings->currentPage() - 1 }}">Anterior</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        @endif

        @for( $cont = 0; $cont < $buildings->lastPage(); $cont++ )
            @if( $buildings->currentPage() == $cont + 1)
                <li class="page-item active"><a class="page-link" href="">{{ $cont + 1 }}</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ action('Admin\BuildingsController@index') }}?page={{ $cont + 1 }}">{{ $cont + 1 }}</a></li>
            @endif
        @endfor

        @if( $buildings->currentPage() < $buildings->lastPage() )
            <li class="page-item">
                <a class="page-link" href="{{ action('Admin\BuildingsController@index') }}?page={{ $buildings->currentPage() + 1 }}">Próximo</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Próximo</span>
            </li>
        @endif
    </ul>
</nav>
@endsection
