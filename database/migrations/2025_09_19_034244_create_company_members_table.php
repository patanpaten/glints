<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_members', function (Blueprint $table) {
            $table->id();

            // Hubungan dengan perusahaan
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            // Data anggota tim
            $table->string('first_name');              // Nama depan
            $table->string('last_name')->nullable();   // Nama belakang (opsional)
            $table->string('email')->unique();         // Email anggota
            $table->string('phone')->nullable();       // Nomor telepon (opsional)
            $table->string('password')->nullable();    // Password (opsional)

            // Peran anggota di perusahaan
            $table->enum('role', ['ADMIN', 'RECRUITER'])->default('RECRUITER');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_members');
    }
};
