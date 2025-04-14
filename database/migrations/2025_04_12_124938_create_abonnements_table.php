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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id('codeabo');
            $table->date('dateabo');
            $table->decimal('totalhtabo', 10, 2);
            $table->decimal('totalremise', 10, 2);
            $table->decimal('totalht', 10, 2);
            $table->decimal('totalttc', 10, 2);
            $table->boolean('solde');
            $table->decimal('restepaye', 10, 2);
            $table->decimal('mtpaye', 10, 2);
            $table->date('datedeb');
            $table->date('datefin');
            $table->foreignId('adherent_code')->constrained('adherents', 'code');
            $table->foreignId('type_abonnement_code')->constrained('type_abonnements', 'code');
            $table->foreignId('categorie_abonnement_codecateg')->constrained('categorie_abonnements', 'codecateg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
