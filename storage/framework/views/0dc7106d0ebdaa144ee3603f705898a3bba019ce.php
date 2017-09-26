
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4A5459">
    <a class="navbar-brand" href="/">Sistema Hórus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="menu-item-home">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <?php if( Auth::user()->category != 'Ag'): ?>
                <?php if( Auth::user()->category === 'P'): ?>
                    <li class="nav-item" id="menu-item-buildings">
                        <a class="nav-link" href="<?php echo e(action('BuildingsController@index')); ?>">Unidades</a>
                    </li>
                    <li class="nav-item" id="menu-item-reports">
                        <a class="nav-link" href="<?php echo e(action('ReportsController@index')); ?>">Relatórios</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item" id="menu-item-buildings">
                        <a class="nav-link" href="<?php echo e(action('BuildingsController@index')); ?>">Unidades</a>
                    </li>
                    <li class="nav-item" id="menu-item-employees" >
                        <a class="nav-link"href="<?php echo e(action('EmployeesController@index')); ?>">Agentes</a>
                    </li>
                    <li class="nav-item" id="menu-item-reports">
                        <a class="nav-link" href="<?php echo e(action('ReportsController@index')); ?>">Relatórios</a>
                    </li>  
                    <li class="nav-item" id="menu-item-schedules">
                        <a class="nav-link" href="<?php echo e(action('SchedulesController@index')); ?>">Horários</a>
                    </li>          
                    <?php if( Auth::user()->category === 'A'): ?>
                        <li class="nav-item" id="menu-item-users">
                            <a class="nav-link" href="<?php echo e(action('UsersController@index')); ?>">Usuários</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?> 
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(action('UsersController@view', ['id' => Auth::user()->id])); ?>">
                    <i class="fa fa-user-circle fa-fw">&nbsp;</i>Perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="logout" href="">
                    <i class="fa fa-sign-out fa-fw">&nbsp;</i>Sair do sistema
                </a>
            </li>
        </ul>
    </div>
</nav>