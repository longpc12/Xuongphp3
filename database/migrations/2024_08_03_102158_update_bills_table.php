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
        Schema::table('bills', function (Blueprint $table) {
            $table->string('type_pay')->nullable()->after('promotion_id'); // Loại thanh toán
            $table->string('pay_status')->default('unpaid')->after('type_pay'); // Trạng thái thanh toán, mặc định là chưa thanh toán
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('type_pay');
            $table->dropColumn('pay_status');
        });
    }
};
