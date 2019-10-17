<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->bigInteger('usucodigo');
            $table->bigInteger('psocodigo');
            $table->string('usuemail', 100)->unique();
            $table->string('ususenha', 100);
            $table->smallInteger('usuativo')->default(1);
            $table->dateTime('usudatahorainsercao')->useCurrent();
            $table->dateTime('usudatahoramodificacao')->useCurrent();
            
            // pk
            $table->primary('usucodigo');
            
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
        Schema::dropIfExists('tbusuario');
    }
}
