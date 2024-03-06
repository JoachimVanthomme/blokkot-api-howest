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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('street_number');
            $table->string('postcode');
            $table->string('city');
            $table->integer('capacity');
            $table->boolean('is_reservation_mandatory')->default(false);
            $table->string('image_path', 1000);
            $table->string('reservation_link', 1000);
            $table->timestamps();
        });

        Schema::create('locations_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->string('language');
            $table->text('hours');
            $table->text('info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('locations_languages');
    }
};
