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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('ship_districts')->restrictOnDelete();
            $table->foreignId('city_id')->constrained('ship_cities')->restrictOnDelete();
            $table->foreignId('state_id')->constrained('ship_states')->restrictOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->text('notes')->nullable();

            $table->string('payment_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency');
            $table->float('amount',8,2);
            $table->integer('discount_amount')->nullable();
            $table->string('order_number')->nullable()->index();

            $table->string('invoice_number')->index();
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');

            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('picked_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->integer('return_order')->default(0);
            $table->string('return_reason')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
