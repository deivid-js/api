<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbendereco', function (Blueprint $table) {
            $table->bigInteger('endcodigo');
            $table->bigInteger('psocodigo');
            $table->char('endestado', 2);
            $table->string('endcidade', 100);
            $table->string('endbairro', 100);
            $table->string('endlogradouro', 100);
            $table->integer('endnumero');
            $table->string('endcomplemento')->nullable();
            $table->string('endreferencia')->nullable();
            $table->string('endobservacao')->nullable();
            
            // pk
            $table->primary('endcodigo');
            
            // fk <- tbpessoa
            $table->foreign('psocodigo')->references('psocodigo')->on('tbpessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbendereco');
    }
}
