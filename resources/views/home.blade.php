@extends('layouts.layout')

@push('header')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/c3/c3.min.css')}}" >


@endpush
@section('content')


<!-- Page-Title -->
<div class="row ">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">ClubEX</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>

                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->


<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-info pull-left">
                <i class="md md-add-shopping-cart text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">R$
                        {{$totalComissoes->first()->totalComissao ?? '0,00'}}</span>
                </h3>
                <p class="text-muted mb-0">Total Comissões Real</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-pink pull-left">
                <i class="md md-attach-money text-white"></i>

            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">R$ {{$rendimentoMes ?? ''}}</span></h3>
                <p class="text-muted mb-0">Rendimento Acumulado</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-purple pull-left">
                <i class="md md-equalizer text-white"></i>
            </div> 
            <div class="text-right">
                <h3 class="text-dark">R$ {{$acumulado ?? ''}}</h3>
                <p class="text-muted mb-0">Total Acumulado</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-success pull-left">
                <i class="fa fa-money fa-4x text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><span class="counter">R$ {{$cda}}</span></h3>
                <p class="text-muted mb-0">Saldo Disponível</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 card-box">
        <div class="table-responsive">
            <table class="table table-actions-bar m-b-0">
                <thead>
                    <tr>
                        <th>Data da Venda</th>
                        <th>Valor Comissão</th>
                        <th>Total Acumulado</th>
                        <th>Projeção Mês</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($comissoes)
                    @foreach($comissoes as $comissao)
                    <tr>

                        <td>{{$comissao->data_venda}}</td>
                        <td>{{number_format($comissao->comissao, 2,',', '.')}}</td>
                        <td>{{number_format($comissao->rendimento->last()->saldo_corrente,2 ,',', '.')}}</td>
                        <td>{{number_format($comissao->comissao * (1+($taxa->rendimento_mes/100)) ,2, ',', '.')}}</td>
                        <td><button type="button" class="btn btn-xs btn-outline-success" 
                        onclick="javascript:solicitaSaque({{$comissao->id}},
                                 {{$comissao->associado_id}},
                                 {{$comissao->rendimento->last()->saldo_corrente}} );">
                                 Sacar</button></td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        
    </div>
    <div class="col-lg-6">
                                <div class="card-box">
                                    <h4 class="m-t-0 m-b-30 header-title"><b>Grafico de Rendimentos por Comissões</b></h4>

                                    <div id="chart"></div>
                                </div>
                            </div>
</div>
<!-- end col -->
<!-- end row -->
@endsection

@push('jsImport')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src ="{{asset('js/moeda.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/plugins/c3/c3.min.js')}}"></script>


        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>

@endpush

@push('jsScripts')
<script>
var comissao = {!!json_encode($chart)!!}
 c3.generate({
            bindto: '#chart',
            data: {
                json:{!!json_encode($chart)!!},
                 keys: {
                     // x: 'name', // it's possible to specify 'x' when category axis
                    value: ['comissao', 'rendimento', 'acumulado']
                        },
                type: 'bar',
                colors: {
                    comissao: '#dcdcdc',
                    rendimento: '#5d9cec',
                    acumulado: '#5fbeaa'
                }
                
            }
        });

</script>


@if(isset($msg))

<script>
Swal.fire({
    title: `{{$msg['title']}}`,
    text: `{{$msg['text']}}`,
    icon: `{{$msg['icon']}}`,
    confirmButtonText: 'Cool'
})
</script>
@endif

<script>
function solicitaSaque(comissao_id, associado_id, valor){
    Swal.fire({
  title: 'Solicitação de Saque?',
  text: `Confirmar solicitação de saque no valor de R$ ${valor.formatMoney(2, "R$ ", ".", ",")}?`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sim, confirma Solicitação!'
}).then((result) => {
    if (result.value) {
            $.ajax({
                method : "GET",
                url :`/cash/create/${comissao_id}/${associado_id}/${valor}`
            }).then((data) =>{
                if(data == "true"){
                Swal.fire(
                    'OK!',
                    'Solicitação de saque realizada com sucesso.',
                    'success')
                }else{
                 Swal.fire(
                    'Erro!',
                    'Falha na solicitação de saque. Comunique adminsitrador do Sistema !',
                    'erro')
                }
                if(data == "found"){
                    Swal.fire(
                    'Erro!',
                    'Saque solicitado anteriormente, aguardando liberação!',
                    'erro')
                }
            })
        }
    })
}

</script>

@endpush