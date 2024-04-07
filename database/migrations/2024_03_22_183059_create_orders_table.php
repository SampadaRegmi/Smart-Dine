<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('order_type', ['take_away', 'dine_in']);
            $table->decimal('sub_total', 10, 2)->default(0.00);;
            $table->decimal('discount', 10, 2)->default(0.00);;
            $table->decimal('total_amount', 10, 2);
            $table->json('order_details')->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
        public function down(): void
    {
        // Drop foreign key constraints
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['user_id']);
        });

        // Rollback the migration
        Schema::dropIfExists('orders');
    }
};
