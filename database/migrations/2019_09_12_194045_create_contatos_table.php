<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbcontato', function (Blueprint $table) {
            $table->bigInteger('concodigo');
            $table->bigInteger('psocodigo');
            $table->bigInteger('tcocodigo');
            $table->string('condescricao', 100);
            
            // pk
            $table->primary('concodigo');
            
            // fk <- tbpessoa
            $table->foreign('psocodigo')->references('psocodigo')->on('tbpessoa');
            
            // fk <- tbtipocontato
            $table->foreign('tcocodigo')->references('tcocodigo')->on('tbtipocontato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbcontato');
    }
}
