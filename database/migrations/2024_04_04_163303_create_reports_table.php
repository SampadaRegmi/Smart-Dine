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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->integer('total_user');
            $table->integer('total_orders');
            $table->decimal('capital', 10, 2);
            $table->decimal('total_transaction', 10, 2);
            $table->decimal('profit_or_loss', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
