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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->decimal('sub_total', 10, 2)->default(0.00);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
