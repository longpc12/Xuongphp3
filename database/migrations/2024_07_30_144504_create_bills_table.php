<?php

use App\Models\Bill;
use App\Models\User;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('code_orders')->unique();
            // Lưu trữ thông tin tài khoản đặt hàng
            $table->foreignIdFor(User::class)->constrained();
            // lưu trữ thông tin người nhận

            $table->string('name_receiver');
            $table->string('email_receiver');
            $table->string('phone_receiver', 10);
            $table->string('Address');
            $table->string('note')->nullable();

            // lưu trữ thông tin quản lý đơn hàng
            $table->string('status_bill')->default(Bill::CHO_XAC_NHAN);
            $table->string('status_payment')->default(Bill::CHUA_THANH_TOAN);

            $table->double('subtotal');
            $table->double('shipping');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
