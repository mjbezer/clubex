<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissao;
use App\Models\Rendimento;
use App\Models\Associado;
use App\Models\RendimentoBaseMes;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $taxa = RendimentoBaseMes::first();
        $associados = Associado::where('user_id', auth()->user()->id)->get();
        foreach($associados as $associado){
                    $totalComissoes = $this->totalCommission($associado->id);
                    $rendimentoMes = $this->monthProfit($associado->id);
                    $acumulado = $this->allProfit($associado->id);
                    $cda = $this->allOver($associado->id);
                    $comissoes = $this->commissionList($associado->id);
                    $chart = $this->chart($associado->id);
        }
        return view('home')->with('totalComissoes', $totalComissoes)
            ->with('rendimentoMes', $rendimentoMes)
            ->with('acumulado', $acumulado)
            ->with('cda',$cda)
            ->with('taxa', $taxa)
            ->with('chart', $chart)
            ->with('comissoes', $comissoes);
        
    }

    public function totalCommission($associado_id)
    {
        $comissoesTotal = Comissao::getSumCommission($associado_id);
        if($comissoesTotal > 0){
            return  $comissoesTotal;
        }else{
            return  $comissoesTotal=0;
        }
        dd($comissoesTotal);
    }

    public function monthProfit($associado_id)
    {
        $rendimentoMes = 0;
        $comissoes = Comissao::where('associado_id', $associado_id)->get();
        foreach($comissoes as $comissao){
            $rendimentoMesComissao =  Rendimento::monthProfit($comissao->id);
            $rendimentoMes = $rendimentoMesComissao->first()->rendimento_mes + $rendimentoMes;
        }
        return number_format($rendimentoMes,2,',','.');
    }

    public function allProfit($associado_id)
    {
        $acumulado = 0;
        $comissoes = Comissao::where('associado_id', $associado_id)->get();
        foreach($comissoes as $comissao){
            if($comissao->status==0){
                $totalAcumulado =  Rendimento::allProfit($comissao->id);
                $acumulado= $totalAcumulado->first()->saldo_corrente + $acumulado;
             }
        }
        return number_format($acumulado,2,',','.');
    }

    public function allOver($associado_id)
    {
        $cda = 0;
        $comissoes = Comissao::where('associado_id', $associado_id)->get();
        foreach($comissoes as $comissao){
              if($comissao->status==0){
                    $cdaDisponivel =  Rendimento::allProfit($comissao->id);
                    $cda= $cdaDisponivel->first()->cda_disponivel + $cda;
              }
        }
        return number_format($cda,2,',','.');
    }

    public function commissionList($associado_id)
    {
        $cda = 0;
        $comissoes = Comissao::where('associado_id', $associado_id)
                                ->where('status',0)->get();
        if(isset($comissoes))
        return $comissoes;
        else 
        return $comissoes = '';
    }

    public function chart($associado_id)
    {
         $comissoes = Comissao::where('associado_id', $associado_id)
                        ->where('status',0)->get();
        foreach($comissoes as $comissao){
            $chart[] = ['comissao' => $comissao->comissao,
                        'acumulado' => $comissao->rendimento->last()->saldo_corrente,
                        'rendimento' => $comissao->rendimento->last()->saldo_corrente - $comissao->comissao
                    ];
        }
        return $chart;
    }
}