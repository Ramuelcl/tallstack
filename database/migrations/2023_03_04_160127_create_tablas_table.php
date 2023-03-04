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

        Schema::create('tablas', function (Blueprint $table) {
            $table->bigInteger('tabla');
            $table->bigInteger('tabla_id');
            $table->string('nombre', 45)->charset('utf8');
            $table->string('descripcion', 128)->nullable()->default(null)->charset('utf8');
            $table->boolean('activo')->nullable()->default(true);
            $table->decimal('valor1', 8, 2)->nullable()->default(null);
            $table->string('valor2', 128)->nullable()->default(null);
            $table->boolean('valor3')->nullable()->default(false);
            $table->primary(['tabla', 'tabla_id']);
            $table->index('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablas');
    }
};
