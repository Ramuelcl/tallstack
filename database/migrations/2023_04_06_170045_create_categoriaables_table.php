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

        Schema::create('categoriaables', function (Blueprint $table) {
            $table->foreignId('categoria_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('categoriaable_id');
            $table->string('categoriaable_type');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoriaables');
    }
};
