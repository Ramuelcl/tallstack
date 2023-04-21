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
        Schema::disableForeignKeyConstraints();

        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('razonSocial', 128);
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->boolean('activo')->default(true);
            $table->string('eMail')->unique();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
