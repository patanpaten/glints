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
        Schema::create('cv_searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('search_query');
            $table->json('filters')->nullable(); // skills, experience, education, location
            $table->integer('results_count')->default(0);
            $table->timestamps();
        });

        Schema::create('cv_search_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_search_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained()->onDelete('cascade');
            $table->decimal('match_score', 5, 2); // percentage match
            $table->json('matched_criteria'); // what matched
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_search_results');
        Schema::dropIfExists('cv_searches');
    }
};
