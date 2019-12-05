@extends('layouts.layout')

@push('header')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert2.min.css')}}">

@endpush

@section('content')

<div class="wrapper-page col-lg-12">
    <div class="row m-t-40">
        <div class="col-lg-12">
            <div class="card-box col-lg-12">
                <h4 class="m-t-0 header-title"><b>Taxa de Rendimento Mês {{date('m/Y')}} </b></h4>
                <p class="text-muted m-b-30 font-14">
                    <form class="form-horizontal" action="/rendimento/store" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="mes_base" class="control-label">Mês Base</label>
                                    <input type="Month" class="form-control" id="mes_base" name="mes_base">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rendimento_mes" class="control-label">Taxa de Rendimento </label>
                                    <input type="text" class="form-control" id="rendimento_mes" name="rendimento_mes"
                                        onKeyPress="return(moeda(this,'.',',',event))">
                                </div>
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box text-center">
                <p class="text-muted mb-0"> Taxa de Rendimento Atual: </p>
                <h3 class="text-dark"><span class="counter">
                        {{$rendimentoBaseMes->rendimento_mes ?? '0,00'}}%</h3>
            </div>
        </div>
    </div>


</div>


@endsection
@push('jsImport')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('assets/js/bootstrap-inputmask.min')}}"></script>
<script src="{{asset('src/commission/inputForm.js')}}"></script>
<script src="{{asset('assets/plugins/moeda/moeda-mask.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


@endpush

@push('jsScript')
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