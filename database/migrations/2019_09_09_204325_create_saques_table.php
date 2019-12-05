<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('valor', 12,2)->nulladle();
            $table->date('data_saque')->nulladle();
            $table->boolean('acao')->default(0);
            $table->unsignedBigInteger('associado_id')->unsigned()->nullable();
            $table->foreign('associado_id')->references('id')->on('associados')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('saques');
    }
}