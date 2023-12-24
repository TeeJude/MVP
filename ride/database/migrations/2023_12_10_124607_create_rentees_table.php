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
        Schema::create('rentees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('surname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('city');
            $table->string('addresss');
            $table->string('driver_liscence_image')->nullable();
            $table->string('driver_liscence_number')->nullable();
            $table->string('id_card_image')->nullable();
            $table->string('id_card_nuber')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentees');
    }
};