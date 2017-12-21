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
          <a role="button" class="btn btn-primary" href="{{ action('ReportsController@new') }}"><i class="fa fa-plus fw"></i> Novo</a>   
    </div>
</div>

<br />

<table id="reports-table" class="table table-sm table-responsive">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Unidade</th>
            <th>Criado</th>
            <th>Atualizado</th>
            <th></th>
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
                    <a role="button" class="btn btn-secondary" href="{{ action('ReportsController@view', ['id' => $report->id]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('ReportsController@edit', ['id' => $report->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-warning" href="{{ action('ReportsController@generatePDF', ['id' => $report->id]) }}"><i class="fa fa-file-pdf-o"></i></a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('ReportsController@delete', ['id' => $report->id]) }}">
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
@endsection

@section('js')
    <script>
        $('#reports-table').DataTable({
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