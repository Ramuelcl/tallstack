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

        Schema::create('marcadorables', function (Blueprint $table) {
            $table->foreignId('marcador_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('marcadorable_id');
            $table->string('marcadorable_type');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcadorables');
    }
};
