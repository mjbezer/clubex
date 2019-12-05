<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ferramenta de admistração de comissões para associados">
    <meta name="author" content="M2F Soluções">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <title>Club-EX</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

   @stack('header')


</head>

<body>
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                    <!--UBold-->
                    <!--</a>-->
                    <!-- Image Logo -->
                    <a href="#" class="logo">
                        <img src="{{asset('assets/images/logo_clubex.png')}}" alt="" class="img-logo">
                    </a>

                </div>

                <div class="menu-extras topbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user text-white"
                                data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                Ola {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <a href="/associate/edit/{{Auth::user()->id}}" class="dropdown-item notify-item">
                                    <i class="md md-account-circle"></i> <span>Perfil</span>
                                </a>
                                <a href="/user/editPassword/{{Auth::user()->id}}" class="dropdown-item notify-item">
                                    <i class="md  md-lock-outline"></i> <span>Alterar Senha</span>
                                </a>

                                <!-- item-->
                                <a href="{{route('logout')}}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="md md-settings-power"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>



                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        @if(Auth::user()->category == 1)
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li>
                            <a href="/associates"><i class="md md-account-circle"></i>Associados</a>
                        </li>
                        <li>
                            <a href="/rendimento/form"><i class="fa  fa-line-chart"></i>Manutenção de Taxas</a>
                        </li>


                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
        @endif
    </header>
    <div class="wrapper-dashboard">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    © 2019 - ClubEX <small>Import and Export</small>- M2F Soluções WEB
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script><!-- Popper for Bootstrap -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/jquery.core.js')}}"></script>
    <script src="{{asset('assets/js/jquery.app.js')}}"></script>


    @stack('jsImport')



    @stack('jsScripts')
</body>

</html>