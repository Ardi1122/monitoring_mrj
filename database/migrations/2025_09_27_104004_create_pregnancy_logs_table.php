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
        Schema::create('pregnancy_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_hamil_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->json('symptoms')->nullable();
            $table->string('mood')->nullable();
            $table->string('appetite')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancy_logs');
    }
};
