<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saque;
use App\Models\Comissao;
use App\Models\Rendimento;

class SaqueController extends Controller
{
    static function getByAssociate($associado_id)
    {
       $saques =  Saque::where('associado_id'. $associado_id)->get();
       return json_encode($saques);
    }

    static function getAll()
    {
        $saque = Saque::with('associado', 'comissao')
                        ->where('acao', 0)->get();
        return $saque;
    }

    public function store($comissao_id, $associado_id, $valor)
    { 
        $verify = Saque::where('comissao_id', $comissao_id)->get();
        if ($verify->count()>0){
            $solicitacao =  "found";
            return $solicitacao;
        }
        try{
            $saque = new Saque;
            $saque->comissao_id = $comissao_id;
            $saque->associado_id = $associado_id;
            $saque->valor = $valor;
            $saque->save();
            $solicitacao =  "true";
        }catch (Exception $e) {
            $solicitacao = "false";               
            }
            return $solicitacao;
    }

    public function authorization($id)
    {
        try{
        $autorizacao = Saque::find($id);
        $autorizacao->acao = 1;
        $autorizacao->data_saque = date('Y-m-d');
        $autorizacao->update();
        
        $baixaComissao = Comissao::find($autorizacao->comissao_id);
        $baixaComissao->status = 1;
        $baixaComissao->update();

        $baixaRendimento = Rendimento::where('comissao_id',$autorizacao->comissao_id);
        $baixaRendimento->status =1;
        $baixaRendimento->delete();

        $autorizado ="true";
        }catch (Exception $e) {
            $autorizado = "false";               
            }
        return $autorizado;
    }
}