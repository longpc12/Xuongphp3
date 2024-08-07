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
        Schema::create('vnpay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id'); // Khóa ngoại liên kết với bảng bills
            $table->decimal('vnp_Amount', 15, 2);
            $table->string('vnp_BankCode', 10);
            $table->string('vnp_BankTranNo', 50);
            $table->string('vnp_CardType', 20);
            $table->string('vnp_OrderInfo', 255);
            $table->string('vnp_PayDate', 50);
            $table->string('vnp_TmnCode', 50);
            $table->string('vnp_TransactionNo', 50);
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnpay');
    }
};
