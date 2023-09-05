<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contas_pagars', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_fornec');
            $table->string('descricao');
            $table->decimal('valor');
            $table->decimal('valor_total');
            $table->string('plano_pag');
            $table->integer('parcela');
            $table->integer('num_transent');
            $table->date('dt_vencimento');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_pagars');
    }
};
