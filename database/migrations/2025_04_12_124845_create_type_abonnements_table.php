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
        Schema::create('type_abonnements', function (Blueprint $table) {
            $table->id('code');
            $table->string('designation');
            $table->integer('nbmois');
            $table->integer('nbjours');
            $table->boolean('acceslibre');
            $table->decimal('forfait', 10, 2);
            $table->integer('nbseancesemaine');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_abonnements');
    }
};
