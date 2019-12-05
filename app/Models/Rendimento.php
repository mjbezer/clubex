<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rendimento extends Model
{
   use SoftDeletes;
    protected $table = "rendimentos";
    protected $primaryKey = "id";
    protected $fillable = [
                'comissao_id',
                'rendimento_dia',
                'taxa_dia',
                'saldo_corrente',
                'saldo_bloqueado',
                'cda_disponivel'
                 ];

    public function comissao()
    {
       return $this->hasOne(Comissao::class, 'id', 'comissao_id');
    } 


    static function monthProfit($comissao_id)
    {
       $mesCorrente = date('Y-m');
       return Rendimento::whereMonth('created_at', date('m'))
                 ->where('comissao_id',$comissao_id)
                 ->selectRaw('sum(rendimento_dia) as rendimento_mes')
                 ->get();                 
    }

     static function allProfit($comissao_id)
    {
       return Rendimento::where('comissao_id',$comissao_id)
                         ->orderBy('id', 'DESC')
                         ->limit(1  )
                         ->get();                 
    }

    

   
}