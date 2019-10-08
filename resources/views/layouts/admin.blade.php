<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
        <!--if lt IE 9
        script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
        script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
        -->
    </head>
    <body class="sidebar-mini fixed">
        <div class="wrapper">
            <!-- Navbar-->
            <header class="main-header hidden-print"><a class="logo" href="{{route('home')}}">{{ config('app.name') }}</a>
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
                    <!-- Navbar Right Menu-->
                    <div class="navbar-custom-menu">
                        <ul class="top-nav">
                            <!--Notification Menu-->
                            <li class="dropdown notification-menu"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog fa-lg"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="not-head">Vuelve Pronto!</li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="media" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span class="media-left media-icon">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                                    <i class="fa fa-sign-out fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </span>
                                            <div class="media-body">
                                                <span class="block">Salir del sistema.</span>
                                                <span class="text-muted block">Adiós</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Side-Nav-->
            <aside class="main-sidebar hidden-print">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image"><img class="img-circle" src="{{asset('images/user.png')}}" alt="User Image"></div>
                        <div class="pull-left info">
                            <p>{{Auth::user()->nombres}}</p>
                            <p class="designation">ADMINISTRADOR (A)</p>
                        </div>
                    </div>
                    <!-- Sidebar Menu-->
                    <ul class="sidebar-menu">
                        @if($location=='inicio')
                        <li class="active"><a href="{{route('home')}}"><i class="fa fa-home"></i><span> Inicio</span></a></li>
                        @else
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i><span> Inicio</span></a></li>
                        @endif
                        @if($location=='cliente')
                        <li class="active"><a href="{{route('cliente.index')}}"><i class="fa fa-user"></i><span> Clientes</span></a></li>
                        @else
                        <li><a href="{{route('cliente.index')}}"><i class="fa fa-user"></i><span> Clientes</span></a></li>
                        @endif
                        @if($location=='consulta')
                        <li class="active"><a href="{{route('cliente.consulta')}}"><i class="fa fa-search"></i><span> Consulta de Clientes</span></a></li>
                        @else
                        <li><a href="{{route('cliente.consulta')}}"><i class="fa fa-search"></i><span> Consulta de Clientes</span></a></li>
                        @endif
                        <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"><i class="fa fa-sign-out"></i><span> Salir del Sistema</span></a></li>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
        <div class="footer" style="text-align: center; width: 100%; height: auto; background-color: #ffffff; padding: 40px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); font-size: 20px;">
            <div class="col-md-12">
                <p>Desarrollado Por <a href="https://www.facebook.com/jorgejeisson">Jeisson Mandon</a> | Todos los derechos reservados 2019</p>
            </div>
        </div>
        <!-- Javascripts-->
        <script type="text/javascript" src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>
        @yield('script')
    </body>
</html>