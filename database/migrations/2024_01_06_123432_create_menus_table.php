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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('keywords');
            $table->string('description');
            $table->string('image')->nullable();
            $table->string('price');
            $table->enum('FoodCategory', ['Veg', 'Non-veg']);
            $table->enum('CourseCategory', ['all','appetizers', 'entree', 'dessert', 'salads','drinks']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
