@extends('layouts.layout')

@push('header')
<link href="{{asset('assets/plugins/footable/css/footable.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/footable/css/FooTable.FontAwesome.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert/sweetalert2.min.css')}}">

@endpush


@section('content')

<div class="row m-t-40">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class=" header-title m-t-10">Associados Ativos</h4>
            <div class="input-group col-8">
            </div>
            <table id="footable_3" class="footable table table-stripped table-actions-bar" data-page-size="20">
                <thead>
                    <th data-name="Nome" data-breakpoints="xs">Nome</th>
                    <th data-name="Abertura">Abertura</th>
                    <th data-name="E-mail" data-breakpoints="xs">E-mail</th>
                    <th data-name="Cidade">Cidade/UF</th>
                    <th data-name="Cep">CEP</th>
                    <th data-name="Fone">Telefone</th>
                    <th data-name="Celular">Celular</th>
                    <th class="text-right"></th>
                </thead>

                <tbody>
                    @foreach($associados as $associado)
                    <tr>
                        <td><a href="/associate/show/{{$associado->id}}">{{$associado->nome}}</td>
                        <td>{{date('d/m/Y', strtotime($associado->data_abertura))}}</td>
                        <td>{{$associado->email}}</td>
                        <td>{{$associado->cidade}}/{{$associado->UF}}</td>
                        <td>{{$associado->cep}}</td>
                        <td>{{$associado->fone}}</td>
                        <td>{{$associado->celular}}</td>
                        <td class="text-right">
                            <button type="button" value="{{ $associado->id}}" onClick="openModal(this.value);"
                                class="btn btn-sm btn-outline-success"><i class="fa fa-dollar"></i></button>
                            <a href="/associete/destroy/{{$associado->id}}" class="btn btn-sm btn-outline-warning"><i
                                    class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="full-width-modalLabel">Lançamento de Comissão </h4>
                            <h6 id="associado_nome">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            </h4>
                            <form action="/commission/store" method="post" class="form-horizontal">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="form-group col-md-4 ml-10">
                                        <input type="hidden" name="associado_id" id="associado_id">
                                        <label class="control-label ">Valor da Comissão(PDA)</label><i class="bar"></i>
                                        <input type="text" id="comissao" class="form-control" name="comissao"
                                            onKeyPress="return(moeda(this,'.',',',event))" parsley-trigger="change"
                                            required />
                                    </div>
                                    <div class="form-group col-md-4 ml-4">
                                        <label class="control-label">Data da venda</label><i class="bar"></i>
                                        <input type="date" id="data_venda" class="form-control" name="data_venda"
                                            parsley-trigger="change" required />

                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary waves-effect"
                                data-dismiss="modal">Cancelar</button>
                            <button type="submit"
                                class="btn btn-outline-success waves-effect waves-light">Salvar</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>

<div class="row">
    <div class="ml-3 mr-4 col-sm-7 card-box">
        <h4 class=" header-title m-t-0">Comissões</h4>
        <div class="table-responsive">
            <table class="table table-actions-bar m-b-0">
                <thead>
                    <tr>
                        <th>Associado</th>
                        <th>Data da Venda</th>
                        <th>Valor Comissão</th>
                        <th>Total Acumulado</th>
                        <th>Projeção Mês</th>
                    </tr>
                </thead>
                <tbody>
                    @if($comissoes)
                    @foreach($comissoes as $comissao)
                    <tr>
                        <td>{{$comissao->associado->nome}}</td>
                        <td>{{$comissao->data_venda}}</td>
                        <td>{{number_format($comissao->comissao, 2,',', '.')}}</td>
                        <td>{{number_format($comissao->rendimento->last()->saldo_corrente ?? 0 ,2 ,',', '.') }}</td>
                        <td>{{number_format($comissao->comissao * (1+($taxa->rendimento_mes/100)) ,2, ',', '.')}}</td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>

    <div class="ml-4 col-sm-4  card-box">
        <h4 class=" header-title m-t-0">Solicitações de Saques</h4>
        <div class="table-responsive">
            <table class="table table-actions-bar">
                <thead>
                    <tr>
                        <th>Associado</th>
                        <th>Comissão</th>
                        <th>Valor</th>
                        <th></th>
                      
                    </tr>
                </thead>
                <tbody>
                    @if(isset($saques))
                    @foreach($saques as $saque)
                    <tr>
                       <td>{{$saque->associado->nome}}</td>
                       <td>{{number_format($saque->comissao->comissao, 2,',', '.')}}</td>
                       <td>{{number_format($saque->valor, 2,',', '.')}}</td>
                        <td><button type="button" class="btn btn-xs btn-outline-success" 
                        onclick="javascript:autorizaSaque( {{$saque->id}} ); ">
                                 liberar</button></td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>

    @endsection

    @push('jsImport')
    <!--FooTable-->
    <script src="{{asset('assets/plugins/footable/js/footable.min.js')}}"></script>
    <script src="{{asset('assets/pages/jquery.footable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!--Notify-->
    <script src="{{asset('assets/plugins/notifyjs/js/notify.js')}}"></script>
    <script src="{{asset('assets/plugins/notifications/notify-metro.js')}}"></script>

    <script src="{{asset('js/moeda.js')}}"></script>

    @endpush

@push('jsScripts')
<script>
    function openModal(value) {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: `/associate/getById/${value}` + location.search
        }).done(function(dados) {
            $('#associado_nome').html(dados.nome)
            $('#associado_id').val(value)
        });
        $('#full-width-modal').modal('show')
    }
</script>
<script>
function autorizaSaque(id){
    Swal.fire({
  title: 'Autorização de Saque?',
  text: `Confirmar autorização de saque?`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sim, confirma Autorização!'
}).then((result) => {
    if (result.value) {
            $.ajax({
                method : "GET",
                url :`/cash/authorization/${id}`
            }).then((data) =>{
                if(data == "true"){
                Swal.fire(
                    'OK!',
                    'Saque autorizado com sucesso.',
                    'success')
                }else{
                 Swal.fire(
                    'Erro!',
                    'Falha na autorização de saque !',
                    'erro')
                }
            })
        }
    })
}
</script>
@endpush