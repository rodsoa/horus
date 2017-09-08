@extends("layouts.base")

@section("content")

<h3 class="card-title text-center">Exibindo usuário {{ Auth::user()->employee->name }} ( {{ Auth::user()->employee->email }} )</h3>

<div class="row justify-content-center">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card card-body">
            
            <p class="card-text">
                <table class="table table-sm table-hover">
                    <thead class="bg-custom-primary">
                        <tr class="text-center">
                            <th colspan="2">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nome: </th>
                            <td class="text-right">{{ Auth::user()->employee->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Matrícula: </th>
                            <td class="text-right">{{ Auth::user()->employee->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Função: </th>
                            <td class="text-right">{{ Auth::user()->employee->employee_category->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Matricula: </th>
                            <td class="text-right">{{ Auth::user()->employee->registration_number }}</td>
                        </tr>
                        <tr>
                                <th scope="row">Tel. Fixo: </th>
                                <td class="text-right">{{ Auth::user()->employee->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Celular: </th>
                            <td class="text-right">{{ Auth::user()->employee->cell_phone }}</td>
                        </tr>
                    </tbody>
                </table>

                <a role="button" class="btn btn-secondary btn-block" href="{{ action('Admin\UsersController@index') }}">Voltar</a>
            </p>
        </div>
        <br />
    </div>
</div>
@endsection