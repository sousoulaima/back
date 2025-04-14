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
        Schema::table('users', function (Blueprint $table) {
            // Add columns only if they don't exist
            if (!Schema::hasColumn('users', 'code')) {
                $table->string('code')->unique()->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'lastName')) {
                $table->string('lastName')->nullable()->after('username');
            }
            if (!Schema::hasColumn('users', 'firstName')) {
                $table->string('firstName')->nullable()->after('lastName');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('Administrateur')->after('email');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('Actif')->after('role');
            }
            if (!Schema::hasColumn('users', 'type_user')) {
                $table->string('type_user')->nullable()->after('status');
            }

            // Make 'name' nullable to avoid conflicts with existing data
            if (Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop columns only if they exist
            if (Schema::hasColumn('users', 'code')) {
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('users', 'lastName')) {
                $table->dropColumn('lastName');
            }
            if (Schema::hasColumn('users', 'firstName')) {
                $table->dropColumn('firstName');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('users', 'type_user')) {
                $table->dropColumn('type_user');
            }

            // Revert 'name' to not nullable if it exists
            if (Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable(false)->change();
            }
        });
    }
};