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
            <a role="button" class="btn btn-primary" href="{{ action('Admin\EmployeeCategoriesController@new') }}">
                <i class="fa fa-plus-circle fa-fw"></i>Novo
            </a>
        </div>
    </div>

    <br />
    
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table class="table table-sm table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th colspan="2">Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $categories as $category)
                    <tr>
                        <td>
                        @if( $category->status )
                            <i class="fa fa-check-circle-o" style="color: green;"></i>
                        @endif

                        @if( !$category->status )
                            <i class="fa fa-times-circle" style="color: red;"></i>
                        @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a role="button" class="btn btn-secondary" href="{{ action('Admin\EmployeeCategoriesController@edit', ['id' => $category->id ]) }}"><i class="fa fa-pencil"></i> editar</a>
                            </div>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <form method="POST" action="{{ action('Admin\EmployeeCategoriesController@delete', ['id' => $category->id]) }}">
                                    {{ csrf_field () }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="delete-{{ $category->id }}" type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection