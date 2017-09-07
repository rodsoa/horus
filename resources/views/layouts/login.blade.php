<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sistema HORUS</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/app.css">
        @section('css')
            @show()
    </head>

    <body id="app" style="padding-top: 120px;">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>