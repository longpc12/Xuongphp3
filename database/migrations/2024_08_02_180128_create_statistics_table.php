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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Ngày thống kê
            $table->integer('total_revenue')->default(0); // Tổng doanh thu
            $table->integer('total_orders')->default(0); // Tổng số đơn hàng
            $table->integer('total_users')->default(0); // Tổng số người dùng đăng ký
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
