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

</head>

<body>

    @yield('content')

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