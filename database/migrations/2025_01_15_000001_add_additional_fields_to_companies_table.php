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
        Schema::table('companies', function (Blueprint $table) {
            $table->text('short_description')->nullable()->after('description');
            $table->text('office_address')->nullable()->after('address');
            $table->string('banner')->nullable()->after('logo');
            $table->string('instagram')->nullable()->after('website');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('facebook');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->text('culture')->nullable()->after('description');
            $table->string('photo')->nullable()->after('banner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'office_address', 
                'banner',
                'instagram',
                'facebook',
                'linkedin',
                'twitter',
                'culture',
                'photo'
            ]);
        });
    }
};