<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alertas', function (Blueprint $table) {
            $table->string('titulo')->nullable;
            $table->integer('tipo')->nullable;
            $table->string('ruta_archivo')->nullable;
            $table->string('url')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alertas', function (Blueprint $table) {
            $table->dropColumn('titulo');
            $table->dropColumn('tipo');
            $table->dropColumn('ruta_archivo');
            $table->dropColumn('url');
        });
    }
};
