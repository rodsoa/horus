@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <a role="button" class="btn btn-primary" href="{{ action('Admin\EmployeeCategoriesController@new') }}">
                <i class="fa fa-plus-circle fa-fw"></i>Novo
            </a>
        </div>
    </div>

    <br />
    
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table table-sm table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $categories as $category)
                    <tr>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->name }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection