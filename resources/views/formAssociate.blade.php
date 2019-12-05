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
    <div class="container-fluid">
        <div class="row ">

            <div class="col-sm-12">
                <div class="card-box">
                    <div class="col-sm-12">
                        <h4 class="m-t-0 header-title"><b>Registro de Associados </b></h4>
                        <p class="text-muted m-b-30 font-14">

                        </p>
                        @if(isset($associado))
                        @foreach ($associado as $associado)
                        <form method="post" action="/client/update/{{$associado->id}}" class="form-horizontal">
                            @method('PUT')
                            @endforeach
                            @else
                            <form method="post" action="/associete/store" class="form-horizontal">

                                @endif
                                @csrf
                                <div class="form-row">
                                    <div class="form-group-custom col-md-4">
                                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" parsley-trigger="change"
                                            required value="@isset($associado){{$associado->cpf_cnpj }}@endisset" />
                                        <label class="control-label">CPF/CNPJ</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <input type="date" id="data_abertura" name="data_abertura"
                                            parsley-trigger="change" required
                                            value="@isset($associado){{$associado->data_abertura }}@endisset" />
                                        <label class="control-label">Data de Abertura</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-6">
                                        <input type="text" id="nome" name="nome" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->nome}}@endisset" />
                                        <label class="control-label">Nome</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <input type="email" id="email" name="email" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->email}}@endisset" />
                                        <label class="control-label">E-mail</label><i class="bar"></i>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-4">
                                        <input type="password" id="password" name="password" parsley-trigger="change"
                                            required value="@isset($associado){{$user->password}}@endisset" />
                                        <label class="control-label">Senha</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <input type="password" id="re-password" data-parsley-equalto="#password"
                                            name="re-password" value="@isset($associado){{$$user->password}}@endisset"
                                            required />
                                        <label class="control-label">Confirmar Senha</label><i class="bar"></i>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-4">
                                        <input type="text" id="cep" name="cep" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->cep}}@endisset" />
                                        <label class="control-label">CEP</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-6">
                                        <input type="text" id="rua" name="endereco" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->endereco}}@endisset" />
                                        <label class="control-label">Endereço</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <input type="text" id="complemento" name="complemento"
                                            value="@isset($associado){{$associado->complemento}}@endisset" />
                                        <label class="control-label">Complemento</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-6">
                                        <input type="text" id="bairro" name="bairro" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->bairro}}@endisset" />
                                        <label class="control-label">Bairro</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-6">
                                        <input type="text" id="cidade" name="cidade" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->cidade}}@endisset" />
                                        <label class="control-label">Cidade</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <select name="UF" id="uf" data-parsley-inputs="change" required>
                                            @if(isset($associado))
                                            1 <option selected value="{{$associado->UF}}">{{$associado->UF}}</option>
                                            @endif
                                            <option value="">Selecione</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                            <option value="EX">Estrangeiro</option>
                                        </select>
                                        <label class="control-label">UF</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-4">
                                        <input type="text" id="fone" name="fone"
                                            value="@isset($associado){{$associado->fone}}@endisset" />
                                        <label class="control-label">Fone</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-4">
                                        <input type="text" id="celular" name="celular"
                                            value="@isset($associado){{$associado->celular}}@endisset" />
                                        <label class="control-label">Celular <i class="fa fa-whatsapp"></i></label><i
                                            class="bar"></i>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="m-t-0 header-title"><b>Dados Bancários </b></h6>
                                <p class="text-muted m-b-30 font-14">

                                </p>
                                <div class="form-row">
                                    <div class="form-group-custom col-md-3">
                                        <input type="text" id="banco" name="banco" parsley-trigger="change" required
                                            value="@isset($associado){{$associado->banco}}@endisset" />
                                        <label class="control-label">Banco</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-3">
                                        <select name="tipo_conta" id="tipo_conta" data-parsley-inputs="change" required>
                                            <option value="">Selecione</option>
                                            <option value="Conta Poupança">Conta Paupança</option>
                                            <option value="Conta Corrente">Conta Corrente</option>

                                        </select>
                                        <label class="control-label">Tipo da Conta</label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-3">
                                        <input type="text" id="agencia" name="agencia"
                                            value="@isset($associado){{$associado->agencia}}@endisset" />
                                        <label class="control-label">Agencia </label><i class="bar"></i>
                                    </div>
                                    <div class="form-group-custom col-md-3">
                                        <input type="text" id="conta" name="conta"
                                            value="@isset($associado){{$associado->conta}}@endisset" />
                                        <label class="control-label">Número da Conta </label><i class="bar"></i>
                                    </div>
                                </div>

                                <div class="form-group text-right m-b-0 col-md-10">

                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Limpar
                                    </button>
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                                        Salvar
                                    </button>
                                </div>
                            </form>





                    </div>
                </div> <!-- end card-box -->
            </div><!-- end col -->
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