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
        Schema::table('applications', function (Blueprint $table) {
            // Modify status enum to include 'interview'
            $table->enum('status', ['pending', 'reviewed', 'shortlisted', 'interview', 'rejected', 'hired'])
                  ->default('pending')
                  ->change();
            
            // Add index for better performance on status queries
            $table->index(['job_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Revert status enum to original
            $table->enum('status', ['pending', 'reviewed', 'shortlisted', 'rejected', 'hired'])
                  ->default('pending')
                  ->change();
            
            // Drop the index
            $table->dropIndex(['job_id', 'status']);
        });
    }
};
