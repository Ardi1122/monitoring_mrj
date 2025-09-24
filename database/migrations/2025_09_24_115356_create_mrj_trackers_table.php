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
        Schema::create('mrj_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kader_id')->constrained('users')->onDelete('cascade'); // user role = pengelola/kader
            $table->date('tanggal');
            $table->integer('jumlah_produksi')->default(0);
            $table->integer('jumlah_distribusi')->default(0);
            $table->integer('stok_sisa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrj_trackers');
    }
};
