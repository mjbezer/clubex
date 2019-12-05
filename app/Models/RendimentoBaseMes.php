<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RendimentoBaseMes extends Model
{
   use SoftDeletes;
    protected $table = "rendimento_base_mes";
    protected $primaryKey = "id";
    protected $fillable = [
                'rendimento_mes',
                'mes_base',
    ];
}