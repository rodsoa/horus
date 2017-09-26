<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema HORUS</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/app.css">
        <?php $__env->startSection('css'); ?>
            <?php echo $__env->yieldSection(); ?>
    </head>

    <body id="app">

        <header class="container">
            <?php echo $__env->make("includes.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form id="form-logout" class="hidden" action="<?php echo e(url('/logout')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

            </form>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php echo $__env->make("includes.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </footer>
        
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <script>
            $(function () {
                // Logout do sistema
                $("#logout").click(function (event) {
                    event.preventDefault();
                    $('#form-logout').submit();
                });
                
                /**
                 * Setando valores corretos para classe 'active' nos menus
                 */
                var urlAtual = window.location.href;
                var item = urlAtual;

                if ( urlAtual.indexOf('?') > 0 ) {
                    item = urlAtual.split("?")[0];
                } 

                item = item.split("/")[3];

                switch ( item ) {
                    case 'usuarios':
                        var oldClasses = document.getElementById('menu-item-users').className;
                        document.getElementById('menu-item-users').className = oldClasses + ' active';
                        break;
                    case 'agentes':
                        var oldClasses = document.getElementById('menu-item-employees').className;
                        document.getElementById('menu-item-employees').className = oldClasses + ' active';
                        break;
                    case 'unidades':
                        var oldClasses = document.getElementById('menu-item-buildings').className;
                        document.getElementById('menu-item-buildings').className = oldClasses + ' active';
                        break;
                    case 'horarios':
                        var oldClasses = document.getElementById('menu-item-schedules').className;
                        document.getElementById('menu-item-schedules').className = oldClasses + ' active';
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
        <?php $__env->startSection('js'); ?>
            <?php echo $__env->yieldSection(); ?>
    </body>
</html>