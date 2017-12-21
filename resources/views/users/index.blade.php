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
            <a role="button" class="btn btn-primary" href="{{ action('UsersController@new') }}">
                <i class="fa fa-plus-circle fa-fw"></i>Novo usuário
            </a>
        </div>
    </div>

    <br />

    <table id="users-table" class="table table-sm">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->category == 'A')
                        ADMINISTRADOR
                    @elseif ($user->category == 'C')
                        COORDENADOR
                    @elseif ($user->category == 'P')
                        PLANTONISTA
                    @else
                        AGENTE
                    @endif
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a role="button" class="btn btn-secondary" href="{{ action('UsersController@view', ['id' => $user->id]) }}"><i class="fa fa-eye"></i> ver</a>
                        <a role="button" class="btn btn-secondary" href="{{ action('UsersController@edit', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <form id="delete-user-form" method="POST" action="{{ action('UsersController@delete', ['id' => $user->id]) }}">
                            {{ csrf_field () }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm">
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
        $('#users-table').DataTable({
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