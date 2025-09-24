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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_hamil_id')->constrained('users')->onDelete('cascade'); // penerima
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // siapa pembuat
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->dateTime('tanggal');
            $table->enum('status', ['pending', 'done'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
