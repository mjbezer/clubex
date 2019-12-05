<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comissao extends Model
{
    use SoftDeletes;
    protected $table = "comissoes";
    protected $primaryKey = "id";
    protected $fillable = [
        'data_venda',
        'comissao',
        'associado_id'
    ];

     public function associado()
     {
         return $this->hasOne(Associado::class, 'id', 'associado_id');
     }

    public function rendimento()
    {
        return $this->hasMany(Rendimento::class, 'comissao_id','id');
    }

    public function getDataVendaAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function getTotalComissaoAttribute($value)
    {
        return number_format($value, 2, ',','.');
    }


    static function getSumCommission($associado_id)
    {
        return Comissao::where('associado_id', $associado_id)
                ->where('status', 0)
                ->selectRaw('sum(comissao) as totalComissao')
                ->groupBy('associado_id')
                ->get();
    }
     
}