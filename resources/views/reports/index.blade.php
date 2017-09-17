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
          <a role="button" class="btn btn-primary" href="{{ action('ReportsController@new') }}"><i class="fa fa-plus fw"></i> Novo</a>   
    </div>
    
    <div class="col-sm-12 col-md-6 col-lg-6">
        <form>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-cog fa-fw"></i>
                    </button>
                </span>
                <input type="text" class="form-control" placeholder="Filtro por Título ou Unidade" aria-label="Filtro por Título ou Unidade" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Pesquisar</button>
                </span>
            </div>
        </form>
    </div>
</div>

<br />

<table class="table table-sm table-responsive">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Unidade</th>
            <th>Criado</th>
            <th colspan="3">Atualizado</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $reports as $report )
        <tr>
            <td>{{ $report->title }}</td>
            <td>{{ $report->building->name }}</td>
            <td>{{ $report->created_at->format('Y-m-d') }}</td>
            <td>{{ $report->updated_at->format('Y-m-d') }}</td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('Employee\ReportsController@view', ['id' => $report->id]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('Employee\ReportsController@edit', ['id' => $report->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-warning" href="{{ action('Employee\ReportsController@print', ['id' => $report->id]) }}"><i class="fa fa-file-pdf-o"></i></a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('Employee\ReportsController@delete', ['id' => $report->id]) }}">
                        {{ csrf_field () }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-{{ $report->id }}" type="submit" class="btn btn-danger btn-sm">
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
        @if( $reports->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ action('Employee\ReportsController@index') }}?page={{ $reports->currentPage() - 1 }}">Anterior</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        @endif

        @for( $cont = 0; $cont < $reports->lastPage(); $cont++ )
            @if( $reports->currentPage() == $cont + 1)
                <li class="page-item active"><a class="page-link" href="">{{ $cont + 1 }}</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ action('Employee\ReportsController@index') }}?page={{ $cont + 1 }}">{{ $cont + 1 }}</a></li>
            @endif
        @endfor

        @if( $reports->currentPage() < $reports->lastPage() )
            <li class="page-item">
                <a class="page-link" href="{{ action('Employee\ReportsController@index') }}?page={{ $reports->currentPage() + 1 }}">Próximo</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Próximo</span>
            </li>
        @endif
    </ul>
</nav>
@endsection