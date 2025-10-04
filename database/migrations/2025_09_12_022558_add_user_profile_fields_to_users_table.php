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
            $table->string('last_name')->nullable()->after('name');
            $table->string('country')->nullable()->after('email_verified_at');
            $table->string('city')->nullable()->after('country');
            $table->string('position')->nullable()->after('city');
            $table->string('nationality')->nullable()->after('position');
            $table->string('preferred_language')->nullable()->after('nationality');
            $table->string('profile_picture')->nullable()->after('preferred_language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name',
                'country',
                'city',
                'position',
                'nationality',
                'preferred_language',
                'profile_picture'
            ]);
        });
    }
};
