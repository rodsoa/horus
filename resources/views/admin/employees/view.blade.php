@extends("layouts.base")

@section("content")

<h3 class="card-title">Exibindo Empregado #{{ $employee-> registration_number }}</h3>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4">
        <div class="card card-body">
            <figure class="figure">
                <img src="/storage/{{ $employee->photo }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                <figcaption class="figure-caption text-center">*Imagem de perfil do empregado</figcaption>
            </figure>
            <p class="card-text">
                <table class="table table-sm table-hover">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <th scope="row">Status: </th>
                            <td class="text-right">
                                <strong>
                                    @if( $employee->status )
                                        <i class="fa fa-check-circle-o" style="color: green;"></i> ATIVO
                                    @endif

                                    @if( !$employee->status )
                                        <i class="fa fa-times-circle-o" style="color: red;"></i> INATIVO|FÉRIAS
                                    @endif
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Nome: </th>
                            <td class="text-right">{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Matrícula: </th>
                            <td class="text-right">{{ $employee->registration_number }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Função: </th>
                            <td class="text-right">{{ $employee->employee_category->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email: </th>
                            <td class="text-right">{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tel. Fixo: </th>
                            <td class="text-right">{{ $employee->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Celular: </th>
                            <td class="text-right">{{ $employee->cell_phone }}</td>
                        </tr>
                    </tbody>
                </table>

                <a role="button" class="btn btn-info btn-block" href="{{ action('Admin\EmployeesController@edit', ['registration_number' => $employee->registration_number]) }}">Atualizar Empregado</a>
                <a role="button" class="btn btn-secondary btn-block" href="{{ action('Admin\EmployeesController@index') }}">Voltar</a>
            </p>
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
                @if( count($employee->work_schedules) )
                    <a role="button" class="btn btn-secondary" href="#">
                        <i class="fa fa-table fa-fw">&nbsp;</i>escala
                    </a>
                @else
                    <a role="button" class="btn btn-secondary" href="#">
                        <i class="fa fa-table fa-fw">&nbsp;</i>escala
                    </a>
                @endif
            </div>

            <div class="btn-group" role="group" aria-label="Third group">
                @if($employee->status)
                    <a role="button" class="btn btn-danger" href="{{ action('Admin\EmployeesController@toggleStatus', ['registration_number' => $employee->registration_number]) }}">Inativar</a>
                @else
                    <a role="button" class="btn btn-success" href="{{ action('Admin\EmployeesController@toggleStatus', ['registration_number' => $employee->registration_number]) }}">Ativar</a>
                @endif
            </div>
        </div>
  
        <br />

        <div id="week-table">

                <table class="table table-sm table-bordered table-responsive">
                    <thead>
                        <tr class="bg-custom-primary">
                            <th colspan=8 class="text-center">
                                Agenda Semanal Eletrônica
                            </th>
                        </tr>
                        <tr class="bg-custom-primary">
                            <th>Hora</th>
                            <th>Segunda</th>
                            <th>Terça</th>
                            <th>Quarta</th>
                            <th>Quinta</th>
                            <th>Sexta</th>
                            <th>Sábado</th>
                            <th>Domingo</th>
                        </tr>
                    </thread>  

                    <tr>
                        <th>10:00 - 11:00</th>
                        
                            <td></td>
                            <td></td>
                            <td title="No Class" class="Holiday"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr>

                    <tr>
                        <th>11:00 - 12:00</th>
                        
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr>

                    <tr>
                        <th>12:00 - 01:00</th>
                        
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr>

                    <tr>
                        <th>01:00 - 02:00</th>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <th>02:00 - 03:00</td>
                    
                        <td>Header</td>
                        <td>Header</td>
                        <td>Header</td>
                        <td>Header</td>
                        <td>Header</td>
                        <td>Header</td>
                        <td>Header</td>
                    </tr>
                </table>
            </div>

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
@endsection