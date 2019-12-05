<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->string('complemento')->nullable;
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('UF')->nullable();
             $table->string('fone')->nullable;
            $table->string('celular')->nullable;
            $table->string('cpf_cnpj')->nullable();
            $table->string('banco')->nullable();
            $table->date('data_abertura')->nullable();
            $table->string('tipo_conta')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta')->nullable();
            $table->decimal('saldo_atual')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associados');
    }
}