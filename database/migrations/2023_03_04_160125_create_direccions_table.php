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

        Schema::create('direccions', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 8);
            $table->string('calle', 50);
            $table->string('codPostal', 6);
            $table->foreignId('ciudad_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->default(null);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccions');
    }
};
