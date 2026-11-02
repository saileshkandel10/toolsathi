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
        Schema::create('vehicle_tax_rules', function (Blueprint $table) {
            $table->id();
            $table->string('province'); // Bagmati, Gandaki, etc.
            $table->string('vehicle_category'); // two-wheeler, four-wheeler, commercial
            $table->string('vehicle_type'); // motorcycle, scooter, private car, etc.
            $table->integer('cc_min')->default(0);
            $table->integer('cc_max')->default(9999);
            $table->string('fiscal_year')->default('2080/81');
            $table->decimal('annual_tax', 10, 2)->default(0.00);
            $table->decimal('renewal_fee', 10, 2)->default(250.00);
            $table->string('source_title')->nullable();
            $table->string('source_url')->nullable();
            $table->date('verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_tax_rules');
    }
};
