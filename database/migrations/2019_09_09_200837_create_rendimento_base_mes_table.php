<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendimentoBaseMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendimento_base_mes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('rendimento_mes', 9,2)->nulladle();
            $table->integer('mes_base')->nulladle();
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
        Schema::dropIfExists('rendimento_base_mes');
    }
}