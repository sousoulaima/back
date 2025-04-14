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
        Schema::create('reservation_salle_formations', function (Blueprint $table) {
            $table->id();
            $table->date('datereservation');
            $table->decimal('montantreservation', 10, 2);
            $table->foreignId('salle_formation_codesalle')->constrained('salle_formations', 'codesalle');
            $table->foreignId('formateur_codefor')->constrained('formateurs', 'codefor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_salle_formations');
    }
};
