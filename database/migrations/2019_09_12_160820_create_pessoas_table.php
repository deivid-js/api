<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbpessoa', function (Blueprint $table) {
            $table->bigInteger('psocodigo');
            $table->string('psonome', 100);
            $table->string('psocpfcnpj', 14)->unique();
            $table->char('psotipo', 1);
            
            // pk
            $table->primary('psocodigo');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbpessoa');
    }
}
