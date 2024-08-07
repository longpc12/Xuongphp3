<?php

use App\Models\Category;
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
            $table->string('slug')->unique()->comment('mã sản phẩm');
            $table->string('name_product');
            $table->string('thumbnail_url')->nullable()->comment('ảnh sản phẩm');
            $table->double('price_regular'); // giá ban đầu
            $table->double('price_sale')->nullable(); // giá sale
            $table->string('description')->nullable(); // mô tả
            $table->text('content')->nullable();
            $table->unsignedBigInteger('quantity')->comment('số lượng');
            $table->unsignedBigInteger('view')->default(0);
            $table->date('input_day')->nullable()->comment('ngày nhập hàng');
            $table->foreignIdFor(Category::class)->constrained();
            $table->boolean('is_type')->default(true);
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_show_home')->default(false);
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
