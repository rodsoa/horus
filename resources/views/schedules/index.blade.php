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
        <a role="button" class="btn btn-primary" href="{{ action('SchedulesController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i>Novo horário
        </a>    
    </div>
</div>

<br />

<table id="schedules-table" class="table table-sm table-hover table-responsive">
    <thead>
        <tr>
            <th>Letra</th>
            <th>Horário</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $schedules as $schedule )
        <tr>
            <td>{{ $schedule->letter }}</td>
            <td><i>{{ $schedule->time_range }}</i></td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('SchedulesController@edit', ['id' => $schedule->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('SchedulesController@delete', ['id' => $schedule->id]) }}">
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
@endsection

@section('js')
    <script>
        $('#schedules-table').DataTable({
            'language': {
                'url': '//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json'
            },
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        });
    </script>
@endsection