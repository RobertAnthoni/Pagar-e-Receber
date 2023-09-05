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
        Schema::create('prev_caixas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('type', 2);
            $table->decimal('valor');
            $table->integer('parcela');
            $table->integer('num_transent');
            $table->integer('conciliado');
            $table->date('dt_vencimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prev_caixas');
    }
};
