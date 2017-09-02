<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/app.css">
        @section('css')
            @show()
    </head>

    <body>

        <header class="container">
            @include("includes.header")
        </header>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            @include("includes.footer")
        </footer>

        <script src="/js/app.js"></script>
        
        @section('js')
            @show()

        <script>
            $(function () {
                /**
                 * Setando valores corretos para classe 'active' nos menus
                 */
                var urlAtual = window.location.href;
                var item = urlAtual;

                if ( urlAtual.indexOf('?') > 0 ) {
                    item = urlAtual.split("?")[0];
                } 

                item = item.split("/")[4];

                switch ( item ) {
                    case 'empregados':
                        var oldClasses = document.getElementById('menu-item-employees').className;
                        document.getElementById('menu-item-employees').className = oldClasses + ' active';
                        break;
                    case 'unidades':
                        var oldClasses = document.getElementById('menu-item-buildings').className;
                        document.getElementById('menu-item-buildings').className = oldClasses + ' active';
                        break;
                    case 'relatorios':
                        var oldClasses = document.getElementById('menu-item-reports').className;
                        document.getElementById('menu-item-reports').className = oldClasses + ' active';
                        break;
                    default:
                        var oldClasses = document.getElementById('menu-item-home').className;
                        document.getElementById('menu-item-home').className = oldClasses + ' active';
                }
            });
        </script>
    </body>
</html>