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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lga_id');
            $table->foreignId('state_id');
            $table->string("model");
            $table->string("brand");
            $table->string("mileage");
            $table->string("registration_number");
            $table->enum("availability_status", ['available', 'in-use', 'under-repair'])->default('available');
            $table->text('description');
            $table->text('pickup_address_details');
            $table->text('image')->nullable();
            $table->decimal('price_per_hour', 15, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};