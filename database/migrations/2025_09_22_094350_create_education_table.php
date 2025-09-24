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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_url')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->enum('type', ['ebook', 'video', 'poster']);
            $table->string('content_url');
            $table->text('description')->nullable();
             $table->unsignedBigInteger('views')->default(0); 
            $table->boolean('is_popular')->default(false);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
