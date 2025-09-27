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
        Schema::create('ibu_hamil_mrj_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_hamil_id')->constrained('users')->onDelete('cascade'); // user role = ibu hamil
            $table->foreignId('mrj_tracker_id')->constrained('mrj_trackers')->onDelete('cascade'); // stok kader
            $table->date('tanggal');
            $table->integer('target_harian')->default(1);
            $table->integer('konsumsi_harian')->default(0);
            $table->integer('stok_sisa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil_mrj_trackers');
    }
};
