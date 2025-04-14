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
        Schema::create('reglements', function (Blueprint $table) {
            $table->id('codereg');
            $table->date('datereg');
            $table->decimal('mtreg', 10, 2);
            $table->string('numchq')->nullable();
            $table->string('numtraite')->nullable();
            $table->text('commentaire')->nullable();
            $table->foreignId('abonnement_codeabo')->constrained('abonnements', 'codeabo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reglements');
    }
};
