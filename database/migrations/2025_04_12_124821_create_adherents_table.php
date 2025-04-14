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
        Schema::create('adherents', function (Blueprint $table) {
            $table->id('code');
            $table->string('nom');
            $table->string('prenom');
            $table->string('profession');
            $table->string('email');
            $table->string('adresse');
            $table->string('tel1');
            $table->string('tel2')->nullable();
            $table->date('datenaissance');
            $table->string('cin');
            $table->string('codetva');
            $table->string('raisonsoc');
            $table->string('idpointage');
            $table->foreignId('societe_code')->constrained('societes', 'code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherents');
    }
};
