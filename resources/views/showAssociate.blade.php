@extends('layouts.layout')

@section('content')
<div class="row">
    @foreach ($associado as $associado)
    <div class="col-sm-12">
        <div class="card-box" style="padding:25px;">
            <div class="form-row">
                <div class="form-group-custom col-md-6">
                    <h3 class="m-t-0"><b>{{$associado->nome}} </b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">CPF/CNPJ</h4>
                    <div class="text-primary">{{$associado->cpf_cnpj }} </div>
                </div>
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Abertura</h4>
                    <div class="text-primary">{{date('d/m/Y', strtotime($associado->data_abertura)) }} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Nome</h4>
                    <div class=" text-primary">{{$associado->nome }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class="m-t-0 header-title">E-mail</h4>
                    <div class="text-primary">{{$associado->email }} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Endereço</h4>
                    <div class="text-primary">{{$associado->endereco }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Complemento</h4>
                    <div class="text-primary">{{$associado->complemento }} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Bairro</h4>
                    <div class="text-primary">{{$associado->bairro }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">CEP</h4>
                    <div class="text-primary">{{$associado->cep }} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Cidade</h4>
                    <div class="text-primary">{{$associado->cidade }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">UF</h4>
                    <div class="text-primary">{{$associado->UF }} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class=" m-t-0 header-title">Telefone</h4>
                    <div class="text-primary">{{$associado->fone }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Celular</h4>
                    <div class="text-primary">{{$associado->celular}} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Banco</h4>
                    <div class="text-primary">{{$associado->banco }} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Tipo da Conta</h4>
                    <div class="text-primary">{{$associado->tipo_conta}} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Agência</h4>
                    <div class="text-primary">{{$associado->agencia}} </div>
                </div>
                <div class="col-md-4">
                    <h4 class=" m-t-0 header-title">Conta</h4>
                    <div class="text-primary">{{$associado->conta}} </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2></h2>

                    <div class="text-sm-left align-bottom">
                        <a href="#" class="btn btn-inverse bt-sm" data-toggle="modal"
                            data-target="#add-commission-modal">Lançar Comissão</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class=" m-t-0 header-title">Saldo Atual</h4>
                    <div>
                        <h3 class="text-success">{{number_format($associado->saldo_atual,2,',','.')}}</h3>
                    </div>
                </div>
            </div>

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>

<!-- modal do form de Lançamento de Comissão -->


<div id="add-commission-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lançamento de Comissão do Associado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal commission" id="commission" method="post">
                @csrf
                <input type="hidden" name="associado_id" id="associado_id" value="{{$associado->id}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{$associado->nome}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_venda" class="control-label">Data da Venda</label>
                                <input type="date" class="form-control" id="data_venda" name="data_venda">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comissao" class="control-label">Valor da Comissão</label>
                                <input type="text" class="form-control" id="comissao" name="comissao"
                                    onKeyPress="return(moeda(this,'.',',',event))">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary waves-effect">Limpar</button>
                        <button type="submit" id="saveCommission"
                            class="btn btn-info waves-effect waves-light">Salvar</button>
                    </div>
            </form>
        </div>
    </div>

</div><!-- /.modal -->


@endforeach
@endsection
@push('jsImport')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{asset('assets/js/bootstrap-inputmask.min')}}"></script>
<script src="{{asset('src/commission/inputForm.js')}}"></script>
<script src="{{asset('assets/plugins/moeda/moeda-mask.js')}}"></script>

<!--FooTable-->
<script src="{{asset('assets/plugins/footable/js/footable.min.js')}}"></script>
<script src="{{asset('assets/pages/jquery.footable.js')}}"></script>
<!--Notification-->
<script src="{{asset('assets/plugins/notifyjs/js/notify.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/notify-metro.js')}}"></script>

@endpush