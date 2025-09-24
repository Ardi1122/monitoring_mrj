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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengelola_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ibu_hamil_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('usia_kehamilan'); // minggu
            $table->decimal('lila', 5, 2);     // cm
            $table->decimal('berat_badan', 5, 2); // kg
            $table->decimal('tinggi_badan', 5, 2)->nullable(); // cm
            $table->integer('tekanan_darah_sistolik')->nullable();  // mmHg
        $table->integer('tekanan_darah_diastolik')->nullable(); // mmHg
            $table->integer('nadi')->nullable(); // x/menit
            $table->integer('respirasi')->nullable(); // x/menit
            $table->string('paritas')->nullable(); // misal "G2P1A0"
            $table->decimal('hb', 5, 2);       // g/dL
            $table->boolean('konsumsi_mrj')->default(false);
            $table->boolean('konsumsi_jely')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
