<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tarea', function (Blueprint $table) {
            $table->text('descripcion')->nullable()->after('estado_tarea');
        });
    }

    public function down()
    {
        Schema::table('tarea', function (Blueprint $table) {
            $table->dropColumn('descripcion');
        });
    }
};
