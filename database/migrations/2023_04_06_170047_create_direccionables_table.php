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

        Schema::create('direccionables', function (Blueprint $table) {
            $table->foreignId('direccion_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('direccionable_id');
            $table->string('direccionable_type');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccionables');
    }
};
