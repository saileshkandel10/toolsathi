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
        Schema::create('nepali_fonts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('Unicode Devanagari'); // Unicode Devanagari, Preeti-compatible, Decorative, etc.
            $table->string('author')->nullable();
            $table->string('format')->default('TTF');
            $table->string('license')->default('Open Source'); // Free, Open Source, Commercial
            $table->string('sample_text')->default('नेपाली भाषा र संस्कृति');
            $table->string('file_path')->nullable();
            $table->string('source_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nepali_fonts');
    }
};
