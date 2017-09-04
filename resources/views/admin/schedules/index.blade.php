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
                    <a role="button" class="btn btn-secondary" href="#"><i class="fa fa-eye"></i> ver</a>
                    <a role="button" class="btn btn-secondary" href="#"><i class="fa fa-pencil"></i> editar</a>
                </div>
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button id="delete-{{ $schedule->id }}" type="submit" class="btn btn-danger" onclick="deleteSchedule({{ $schedule->id }})">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="...">
    <ul class="pagination pagination-sm justify-content-center">
        <li class="page-item disabled">
            <span class="page-link">Anterior</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active">
            <span class="page-link">
            2
            <span class="sr-only">(current)</span>
            </span>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Próximo</a>
        </li>
    </ul>
</nav>
@endsection

@section('js')
<script>
    function deleteBuilding(id) {
        var url = window.location.href + '/' + id + '/deletar';

        if( confirm("Tem certeza em realizar essa ação ?") ) {
            // TODO: Fazer callback mais atraente para essa requisição
            axios.delete(url)
             .then( function (data) {
                 alert('Registro apagado com sucesso.');
             })
             .catch( function (error) {
                 alert('Ocorreu algum erro. Repita a operação.');
             });

            location.reload();
        }
    }
</script>
@endsection