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
    <div class="col-sm-12 col-md-12 col-lg-12">
        <a role="button" class="btn btn-primary" href="{{ action('BuildingsController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i> Nova unidade
        </a>
    </div>
</div>

<br />

<table id="buildings-table" class="table table-sm table-hover table-responsive">
    <thead>
        <tr>
            <th>Status</th>
            <th>Nome</th>
            <th></th>
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
                    <a role="button" class="btn btn-secondary" href="{{ action('BuildingsController@view', ['id' => $building->id ]) }}"><i class="fa fa-eye"></i> ver</a>
                    @if( Auth::user()->category !== "P")
                        <a role="button" class="btn btn-secondary" href="{{ action('BuildingsController@edit', ['id' => $building->id ]) }}"><i class="fa fa-pencil"></i> editar</a>
                    @endif
                </div>
                
                @if( Auth::user()->category !== "P")
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('BuildingsController@delete', ['id' => $building->id]) }}">
                        {{ csrf_field () }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-{{ $building->id }}" type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
    <script>
        $('#buildings-table').DataTable({
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