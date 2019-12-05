<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    use SoftDeletes;
    protected $table = "associados";
    protected $primaryKey = "id";
    protected $fillable = [
        'cpf_cnpj',
        'data_abertura',
        'nome',
        'email',
        'endereco',
        'complemento',
        'bairro',
        'cep',
        'cidade',
        'UF',
        'fone',
        'celular',
        'tipo_conta',
        'banco',
        'agencia',
        'conta',
        'user_id'
    ];

     public function comissao()
     {
         return $this->hasMany(Comissao::class, 'associado_id', 'id');
     }

 
}