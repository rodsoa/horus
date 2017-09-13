@extends('layouts.base')

@section('content')
<h3 class="card-title">Exibir informações de {{ $building->name }}</h3>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-responsive">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Status:</th>
                            <td class="text-right">
                                @if( $building->status )
                                    <i class="fa fa-check-circle-o" style="color: green;"></i> Ativo
                                @endif

                                @if( !$building->status )
                                    <i class="fa fa-times-circle" style="color: red;"></i> Inativo
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Nome:</th>
                            <td class="text-right">{{ $building->name }}</td>
                        </tr>
                        <tr>
                            <th>Endereço:</th>
                            <td class="text-right">{{ $building->address }}</td>
                        </tr>
                        <tr>
                            <th>Descrição:</th>
                            <td class="text-right">{{ $building->description }}</td>
                        </tr>
                    </tbody>
                </table>

                <a role="button" class="btn btn-block btn-info" href="{{ action('Admin\BuildingsController@edit', ['id' => $building->id ]) }}">Atualizar Unidade</a>
                <a role="button" class="btn btn-block btn-secondary" href="{{ action('Admin\BuildingsController@index') }}">Retornar</a>
            </div>
        </div>
        <br />
    </div>

    <div class="col-sm-12 col-md-8 col-lg-8">
        
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button type="button" class="btn btn-secondary">pdf</button>
                <button type="button" class="btn btn-secondary">excel</button>
            </div>

            <div class="btn-group mr-2" role="group" aria-label="Second group">
                @if( count($building->work_schedules) )
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-table fa-fw"></i>Gerenciar escalas
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ action('Admin\WorkSchedulesController@editFromBuilding', ['id' => $building->id]) }}"><i class="fa fa-pencil fa-fw"></i>editar escala</a>
                            <a class="dropdown-item" href="{{ action('Admin\WorkSchedulesController@newFromBuilding', ['id' => $building->id]) }}"><i class="fa fa-plus fa-fw"></i>adicionar escala</a>
                        </div>
                    </div>
                @else
                    <a role="button" class="btn btn-secondary" href="{{ action('Admin\WorkSchedulesController@newFromBuilding', ['id' => $building->id]) }}">
                        <i class="fa fa-table fa-fw">&nbsp;</i>escala
                    </a>
                @endif
            </div>

            <div class="btn-group" role="group" aria-label="Third group">
                @if($building->status)
                    <a role="button" class="btn btn-danger" href="{{ action('Admin\BuildingsController@toggleStatus', ['id' => $building->id]) }}">Inativar</a>
                @else
                    <a role="button" class="btn btn-success" href="{{ action('Admin\BuildingsController@toggleStatus', ['id' => $building->id]) }}">Ativar</a>
                @endif
            </div>
        </div>
  
        <table class="table table-sm table-hover" style="margin-top: 15px;">
            <thead class="bg-custom-primary">
                <tr class="text-center">
                    <th colspan="2">Agenda Eletrônica</th>
                </tr>
            </thead>
        </table>
        <div id="building-calendar" style="margin-bottom: 20px;"></div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                 <div class="card card-body">
                    RELATORIOS DE SERVIÇO
                </div>

                <br />
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                 <div class="card card-body">
                    INFOS COMPLEMENTARES
                </div>

                <br />
            </div>
        </div>

        <div class="card card-body">
            REGISTROS DE PROTOCOLOS DE ENTREGA/RECEBIMENTO DE CHAVES
        </div>
    </div>
</div>

<br />
@endsection

@section('js')
<script>
    $('#building-calendar').fullCalendar({
        locale: 'pt-br',
        events: '/api/buildings/{{ $building->id }}/get-all-workschedules'
    });
</script>
@endsection