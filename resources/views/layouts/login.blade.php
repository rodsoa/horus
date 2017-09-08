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

    <body id="app" style="padding-top: 8%;">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-custom-primary" style="height: 60px; margin-bottom: 12px;">
                                <center>
                                    <h3 style="padding-top: 15px;">LOGIN HORUS</h3>
                                </center>
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>