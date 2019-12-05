@extends('layouts.template')

@push('header')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert2.min.css')}}">

@endpush
@section('content')

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



            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
</header>
<div class="wrapper-page">
    <div class="text-center align-self-sm-center">
        <div class="card-box">
            <div class="panel-heading">
                <h4 class="text-center"> Alterar <strong class="text-custom">Senha</strong></h4>
            </div>
            <div class="p-20">
                <form class="form-horizontal m-t-20" method="post" action="/user/updatePassword/{{$id}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group ">
                        <div class="col-12">
                            <input class="form-control" type="password" name="senha_atual" required=""
                                placeholder="Senha Atual" parsley-trigger="change">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-12">
                            <input class="form-control" type="password" name="nova_senha" required=""
                                placeholder="Nova Senha" id="password" parsley-trigger="change">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <input class="form-control" type="password" name="repete_nova_senha" required=""
                                placeholder="Repetir Senha" id="re-password" data-parsley-equalto="#password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-success">Alterar Senha</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@push('jsImport')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('assets/plugins/notifyjs/js/notify.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/notify-metro.js')}}"></script>
<script src="{{asset('assets/plugins/search-zipcode-br/zipcode.br.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('assets/plugins/parsleyjs/pt-br.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush
@push('jsScripts')

<script>
$(document).ready(function() {
    $('input').keypress(function(e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);
        return (code == 13) ? (code == 9) : true;
    });
});
</script>

<script>
$(document).ready(function() {
    $('form').parsley();
});
</script>
@if(isset($msg))
{{$msg}}
<script>
Swal.fire({
    title: `{{$msg['title']}}`,
    text: `{{$msg['text']}}`,
    icon: `{{$msg['icon']}}`,
    confirmButtonText: 'Cool'
})
</script>
@endif
@endpush