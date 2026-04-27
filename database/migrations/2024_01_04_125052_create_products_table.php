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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->string('product_name');
            $table->string('product_slug')->index();
            $table->string('product_code')->index();
            $table->string('product_quantity');
            $table->string('product_tags')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->text('short_desc');
            $table->text('long_desc');
            $table->string('product_thumbnail');
            $table->foreignId('vendor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('hot_deals')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('special_offer')->default(false);
            $table->boolean('special_deals')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
