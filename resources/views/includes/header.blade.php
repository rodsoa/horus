
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4A5459">
    <a class="navbar-brand" href="#">Sistema Hórus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="menu-item-home">
                <a class="nav-link" href="@if( Auth::user()->employee) {{ action('Employee\EmployeeController@index') }} @else {{ action('Admin\AdminController@index') }} @endif">Inicio</a>
            </li>
            @if( !count(Auth::user()->employee) )
                <li class="nav-item" id="menu-item-employees" >
                    <a class="nav-link"href="{{ action('Admin\EmployeesController@index') }}">Empregados</a>
                </li>
                <li class="nav-item" id="menu-item-buildings">
                    <a class="nav-link" href="{{ action('Admin\BuildingsController@index') }}">Unidades</a>
                </li>
                <li class="nav-item" id="menu-item-buildings">
                    <a class="nav-link" href="{{ action('Admin\UsersController@index') }}">Usuários</a>
                </li>
                <li class="nav-item" id="menu-item-buildings">
                    <a class="nav-link" href="{{ action('Admin\SchedulesController@index') }}">Horários</a>
                </li>
                <li class="nav-item" id="menu-item-reports">
                    <a class="nav-link" href="#">Relatórios</a>
                </li>
            @else
                <li class="nav-item" id="menu-item-reports">
                    <a class="nav-link" href="#">Relatórios</a>
                </li>
                <li class="nav-item" id="menu-item-reports">
                    <a class="nav-link" href="#">Protocolos</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="@if( Auth::user() ) {{ action('Admin\UsersController@view', ['id' => Auth::user()->id]) }} @endif">
                    <i class="fa fa-user-circle fa-fw">&nbsp;</i>Perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-sign-out fa-fw">&nbsp;</i>Sair do sistema
                </a>
            </li>
        </ul>
    </div>
</nav>