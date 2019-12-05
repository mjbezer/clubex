<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rendimento;
use App\Models\Comissao;
use App\Models\RendimentoBaseMes;
use Illuminate\Database\QueryException;


class RendimentoController extends Controller
{
   public function form()
    {
        $rendimentoBaseMes = RendimentoBaseMes::first();
        return view('formTaxes', ['rendimentoBaseMes'=> $rendimentoBaseMes]);
    }
    
    public function storeOrUpdate(Request $request)
    {
        $request = $request->all();
        $request['mes_base']=date('m',strtotime($request['mes_base']));
        $request['rendimento_mes'] = str_replace(',', '.', str_replace('.', '', $request['rendimento_mes']));
        $rendimentoBaseMes = RendimentoBaseMes::first();
            if(isset($rendimentoBaseMes)){
                try {
                    $updateBaseMes = RendimentoBaseMes::first();
                    $updateBaseMes->update($request);
                    $msg= [
                        'status' => 200,
                        'msg' => 'Alteração realizada com sucesso!'
                    ];
                   return redirect()->back()->with('msg', $msg);
                   
                } catch (Exception $e) {
                    $msg= [
                        'status' => 300,
                        'msg' => $e->getMessage()
                    ];
                   return redirect()->back()->with('msg', $msg);
                   
                }       
            }else{
                try{
                     $BaseMes = RendimentoBaseMes::create($request);
                     $msg = [ 'status' => 200,
                            'msg' => 'Operação realizada com sucesso!',
                            'style'=>'success'];
                    return redirect()->back()->with('msg', $msg);
                }catch (Exception $e) {
                        $msg = [
                            'status' => 500,
                            'msg' => $e->getMessage(),
                            'style'=> 'error'
                        ];
                    }
            }
            
    }

    public function getById($id)
    {
        $rendimentoBaseMes = RendimentoBaseMes::all();
        return $rendimentoBaseMes;
    }

    public function update($request, $id)
       {
        
    }

    static function create()
    {
        $comissoes=Comissao::all();
        $rendimentoBase = RendimentoBaseMes::first();
        if (isset($rendimentoBase)){
            $taxaDia = ($rendimentoBase->rendimento_mes/30)/100;
            $dataCorrente = strtotime(date('Y-m-d'));
                foreach($comissoes as $comissao){
                    if($comissao->status == 0){
                        $rendimento = Rendimento::where('comissao_id', $comissao->id)
                                                ->orderBy('id', 'desc')
                                                ->limit(1)
                                                ->get();
                        if($rendimento->count()==0){
                            $rendimentoDia = $comissao->comissao *  $taxaDia;
                            $saldoCorrente = $comissao->comissao+$rendimentoDia;
                            $saldoBloqueado = $saldoCorrente - $rendimentoDia;
                            $cdaDisp = $rendimentoDia - ($rendimentoDia*0.05);
                            $insertRendimento = new Rendimento;
                            $insertRendimento->comissao_id= $comissao->id;
                            $insertRendimento->rendimento_dia=$rendimentoDia;
                            $insertRendimento->taxa_dia=$taxaDia;
                            $insertRendimento->saldo_corrente=$saldoCorrente;
                            $insertRendimento->saldo_bloqueado=$saldoBloqueado;
                            $insertRendimento->cda_disponivel=$cdaDisp;
                            $insertRendimento->save();
                    }else{ 
                        foreach($rendimento as $rendimentoAnterior){
                            $rendimentoDia = $rendimentoAnterior->saldo_corrente *  $taxaDia;
                            $saldoCorrente = $rendimentoAnterior->saldo_corrente+$rendimentoDia;
                            $saldoBloqueado = $saldoCorrente - $rendimentoDia;
                            $cdaDisp = $rendimentoDia - ($rendimentoDia*0.05);
                            $addRendimento = new Rendimento;
                            $addRendimento->comissao_id= $comissao->id;
                            $addRendimento->rendimento_dia=$rendimentoDia;
                            $addRendimento->taxa_dia=$taxaDia;
                            $addRendimento->saldo_corrente=$saldoCorrente;
                            $addRendimento->saldo_bloqueado=$saldoBloqueado;
                            $addRendimento->cda_disponivel=$cdaDisp;
                            $addRendimento->save();
                        }            
                    }
                    }
                }          
        }
    }   

}


 