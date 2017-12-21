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
        <a role="button" class="btn btn-primary" href="{{ action('EmployeesController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i>Novo agente
        </a>

         <a role="button" class="btn btn-secondary" href="{{ action('EmployeeCategoriesController@index') }}">
             Categorias
        </a>       
    </div>
</div>

<br />

<table id="employees-table" class="table table-sm table-responsive">
    <thead>
        <tr>
            <th>Status</th>
            <th>Nome</th>
            <th>Matrícula</th>
            <th>Lotação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $employees as $employee )
        <tr>
            <td>
                <strong>
                @if( $employee->status === 'A' )
                    <i style="color: #27AE60">ATIVO</i>
                @elseif( $employee->status === 'I' )
                    <i style="color: #CF000F">INATIVO</i>
                @elseif( $employee->status === 'F' )
                    <i style="color: #65878F">FOLGA</i>
                @elseif( $employee->status === 'At' )
                    <i style="color: #6E5D4B">ATESTADO</i>
                @else
                    <i style="color: #F7BC05">FÉRIAS</i>
                @endif
                </strong>
            </td>
            <td>{{ $employee->name }}</td>
            <td><i>{{ $employee->registration_number }}</i></td>
            <td>
                @foreach( $employee->getActualWorkPlaces() as $name )
                    {{ $name }}<br/> 
                @endforeach
            </td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('EmployeesController@view', ['registration_number' => $employee->registration_number]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('EmployeesController@edit', ['registration_number' => $employee->registration_number]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <form method="POST" action="{{ action('EmployeesController@delete', ['registration_number' => $employee->registration_number]) }}">
                        {{ csrf_field () }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-{{ $employee->id }}" type="submit" class="btn btn-danger btn-sm">
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
        $('#employees-table').DataTable({
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
