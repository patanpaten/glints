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
        Schema::create('job_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_listings')->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->integer('unique_views')->default(0);
            $table->integer('applications')->default(0);
            $table->integer('saves')->default(0);
            $table->integer('shares')->default(0);
            $table->date('date');
            $table->timestamps();

            $table->unique(['job_id', 'date']);
        });

        Schema::create('company_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->integer('total_job_views')->default(0);
            $table->integer('total_applications')->default(0);
            $table->integer('active_jobs')->default(0);
            $table->integer('profile_views')->default(0);
            $table->date('date');
            $table->timestamps();

            $table->unique(['company_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_analytics');
        Schema::dropIfExists('job_analytics');
    }
};
