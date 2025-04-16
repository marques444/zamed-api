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
        Schema::create('resultados_exames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_exame_id');
            $table->string('arquivo_pdf'); // link do PDF
            $table->timestamps();
        
            $table->foreign('pedido_exame_id')->references('id')->on('pedidos_exames');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultado_exames');
    }
};
