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
        <a role="button" class="btn btn-primary" href="{{ action('Admin\UsersController@new') }}">
            <i class="fa fa-plus-circle fa-fw"></i>Novo usuário
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

<table class="table table-sm table-responsive">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th colspan="2">Tipo</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $users as $user )
        <tr>
            <td>{{ $user->name }}</td>
            <td><i>{{ $user->email }}</i></td>
            <td>
                @if( $user->employee )
                    {{ $user->employee->employee_category->name }}
                @else
                    ADMINISTRADOR
                @endif
            </td>
            <td class="text-right">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\UsersController@view', ['id' => $user->id]) }}"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\UsersController@edit', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button id="delete-{{ $user->id }}" type="submit" class="btn btn-danger" onclick="deleteUser('{{ $user->id }}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script>
    function deleteUser(id) {
        var url = window.location.href + '/' + id + '/deletar';
        if( confirm("Tem certeza em realizar essa ação ?") ) {
            // TODO: Fazer callback mais atraente para essa requisição
            axios.delete(url)
             .then( function (data) {
                alert("Deletando registros");
             })
             .catch( function (error) {
                 alert(error);
             });

            location.reload();
        }
    }
</script>
@endsection