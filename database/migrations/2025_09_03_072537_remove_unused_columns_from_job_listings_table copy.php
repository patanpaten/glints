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
            // Hapus kolom yang tidak digunakan
            $table->dropColumn([
                'requirements',
                'responsibilities', 
                'salary_range',
                'deadline',
                'is_featured'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Kembalikan kolom yang dihapus
            $table->text('requirements')->nullable()->after('description');
            $table->text('responsibilities')->nullable()->after('requirements');
            $table->string('salary_range')->nullable()->after('education_level');
            $table->date('deadline')->nullable()->after('vacancies');
            $table->boolean('is_featured')->default(false)->after('is_active');
        });
    }
};
