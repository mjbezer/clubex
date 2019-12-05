@extends('layouts.template')


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
<div class="wrapper">

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
$("#cep").keydown(function() {
    $("#cep").mask("99999-999")
    var elem = this;
    setTimeout(function() {
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
})
$("#fone").keydown(function() {
    $("#fone").mask("(99) 9999-9999")
    var elem = this;
    setTimeout(function() {
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
})
$("#celular").keydown(function() {
    $("#celular").mask("(99) 9.9999-9999")
    var elem = this;
    setTimeout(function() {
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
})

$("#cpf_cnpj").keydown(function() {
    try {
        $("#cpf_cnpj").unmask();
    } catch (e) {}

    var tamanho = $("#cpf_cnpj").val().length;
    if (tamanho < 11) {
        $("#cpf_cnpj").mask("999.999.999-99");
    } else {
        $("#cpf_cnpj").mask("99.999.999/9999-99");
    }


    // ajustando foco
    var elem = this;
    setTimeout(function() {
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
});
</script>

<script>
$(document).ready(function() {
    $('form').parsley();
});
</script>

@endpush