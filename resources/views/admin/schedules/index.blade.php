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
        <a role="button" class="btn btn-primary" href="{{ action('Admin\SchedulesController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i>Novo horário
        </a>    
    </div>
</div>

<br />

<table class="table table-sm table-hover table-responsive">
    <thead>
        <tr>
            <th>Letra</th>
            <th colspan="2">Horário</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $schedules as $schedule )
        <tr>
            <td>{{ $schedule->letter }}</td>
            <td><i>{{ $schedule->time_range }}</i></td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\SchedulesController@view', ['id' => $schedule->id]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\SchedulesController@edit', ['id' => $schedule->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('Admin\SchedulesController@delete', ['id' => $schedule->id]) }}">
                        {{ csrf_field () }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-{{ $schedule->id }}" type="submit" class="btn btn-sm btn-danger">
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
        @if( $schedules->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ action('Admin\SchedulesController@index') }}?page={{ $schedules->currentPage() - 1 }}">Anterior</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Anterior</span>
            </li>
        @endif

        @for( $cont = 0; $cont < $schedules->lastPage(); $cont++ )
            @if( $schedules->currentPage() == $cont + 1)
                <li class="page-item active"><a class="page-link" href="">{{ $cont + 1 }}</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ action('Admin\SchedulesController@index') }}?page={{ $cont + 1 }}">{{ $cont + 1 }}</a></li>
            @endif
        @endfor

        @if( $schedules->currentPage() < $schedules->lastPage() )
            <li class="page-item">
                <a class="page-link" href="{{ action('Admin\SchedulesController@index') }}?page={{ $schedules->currentPage() + 1 }}">Próximo</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Próximo</span>
            </li>
        @endif
    </ul>
</nav>
@endsection