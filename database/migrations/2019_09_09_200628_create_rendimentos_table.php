<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('rendimento_dia', 12, 2)->nulladle();
            $table->decimal('renda_bruta', 12,2)->nulladle();
            $table->decimal('taxa_dia', 12,2)->nulladle();
            $table->decimal('cda_bruto', 12,2)->nulladle();
            $table->decimal('saldo_corrente', 12,2)->nulladle();
            $table->decimal('cda_disponivel', 12,2)->nulladle();
            $table->boolean('status')->default(1);
            $table->date('data_operacao')->nulladle();
            $table->unsignedBigInteger('comissao_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendimentos');
    }
}