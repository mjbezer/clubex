<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saques', function (Blueprint $table) {
            $table->unsignedBigInteger('comissao_id')->nullable();
            $table->foreign('comissao_id')->references('id')->on('comissoes')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saques', function (Blueprint $table) {
            //
        });
    }
}
