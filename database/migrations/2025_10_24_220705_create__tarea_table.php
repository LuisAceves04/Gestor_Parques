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
        Schema::create('tarea', function (Blueprint $table) {
            $table->id('idTarea');
            $table->foreignId("idReporte")->constrained("reporte", "idReporte")->onDelete("cascade"); 
            $table->foreignId("idEmpleado")->constrained("empleado", "idEmpleado")->onDelete("cascade");
            $table->timestamp('fecha_asignacion')->useCurrent();
            $table->string('estado_tarea');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea');
    }
};
