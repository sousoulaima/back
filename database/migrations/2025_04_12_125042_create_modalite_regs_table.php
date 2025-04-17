<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modalite_regs', function (Blueprint $table) {
            $table->string('codeMod')->primary();
            $table->string('designationMod');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modalite_regs');
    }
};