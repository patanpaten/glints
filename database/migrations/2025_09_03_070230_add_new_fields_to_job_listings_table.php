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
        Schema::table('job_listings', function (Blueprint $table) {
            // Sistem kerja
            $table->enum('work_system', ['onsite', 'remote', 'hybrid'])->nullable()->after('employment_type');

            // Lokasi
            $table->string('country')->nullable()->after('location');
            $table->text('office_address')->nullable()->after('country');

            // Gaji
            $table->decimal('salary_min', 15, 2)->nullable()->after('salary_range');
            $table->decimal('salary_max', 15, 2)->nullable()->after('salary_min');
            $table->string('bonus')->nullable();
            $table->boolean('hide_salary')->default(false)->after('bonus');

            // Persyaratan kerja
            $table->enum('gender', ['male', 'female', 'any'])->default('any')->after('education_level');
            $table->integer('age_min')->nullable()->after('gender');
            $table->integer('age_max')->nullable()->after('age_min');
            $table->boolean('no_age_limit')->default(false)->after('age_max');
            $table->text('skills')->nullable()->after('no_age_limit');

            // Persyaratan wajib tambahan
            $table->boolean('require_photo')->default(false)->after('skills');
            $table->boolean('require_cv')->default(false)->after('require_photo');

            // VIP features
            $table->boolean('vip_location')->default(false)->after('require_cv');
            $table->boolean('vip_education')->default(false)->after('vip_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'work_system',
                'country',
                'office_address',
                'salary_min',
                'salary_max',
                'bonus',
                'hide_salary',
                'gender',
                'age_min',
                'age_max',
                'no_age_limit',
                'skills',
                'require_photo',
                'require_cv',
                'vip_location',
                'vip_education'
            ]);
        });
    }
};
