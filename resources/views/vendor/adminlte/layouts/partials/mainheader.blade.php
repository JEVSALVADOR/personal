<header class="main-header">

    <a href="{{ url('/home') }}" class="logo">
        <span class="logo-mini"><b>P</b>J</span>
        <span class="logo-lg"><b> C.S.J. </b>ANCASH </span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
       
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @if (Auth::guest())
                    <!-- <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li> -->
                    <li><a href="{{ url('/login') }}">Acceso</a></li>
                @else
                    
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('/img/av1.png')}}" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">{{ Auth::user()->personal->apellidosnombres }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li class="user-header">
                                <img src="{{asset('/img/av1.png')}}" class="img-circle" alt="User Image" />
                                <p>
                                    
                                    <small style="font-size: 14px;">{{ Auth::user()->email }}</small>
                                    <small>{{ Auth::user()->tipouser->descripcion }}</small>
                                </p>
                            </li>

                            <li class="user-body" style="padding-top: 2px;padding-bottom: 2px;">
                            </li>
                       
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-warning btn-flat">Mi Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-danger btn-flat"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Control Sidebar Toggle Button -->
<!--                 <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
