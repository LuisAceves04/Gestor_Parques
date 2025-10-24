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
        Schema::create('reporte', function (Blueprint $table) {
            $table->id("idReporte");
            $table->foreignId("idUsuario")->constrained("usuario", "idUsuario")->onDelete("cascade"); 
            $table->foreignId("idParque")->constrained("parque", "idParque")->onDelete("cascade");
            $table->text("descripcion");
            $table->string('estado');
            $table->timestamp('fecha_reporte')->useCurrent();
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};