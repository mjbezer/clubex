<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saque extends Model
{
   use SoftDeletes;

   protected $table  = 'saques';
   protected $primaryKey ='id';
   protected $fillable = [
    'valor',
    'data_saque',
    'acao',
    'associado_id',
    'comissao_id'
   ];

   public function associado()
   {
       return $this->hasOne(Associado::class, 'id', 'associado_id');
   }

   public function comissao()
   {
       return $this->hasOne(Comissao::class, 'id', 'comissao_id');
   }
   
}
