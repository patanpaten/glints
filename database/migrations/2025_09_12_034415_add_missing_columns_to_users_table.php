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
            // Add missing columns that are not in the current table
            if (!Schema::hasColumn('users', 'position')) {
                $table->string('position')->nullable()->after('city');
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable()->after('position');
            }
            if (!Schema::hasColumn('users', 'preferred_language')) {
                $table->string('preferred_language')->nullable()->after('nationality');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'position',
                'nationality', 
                'preferred_language'
            ]);
        });
    }
};
