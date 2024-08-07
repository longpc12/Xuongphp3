<?php

use App\Models\Bill;
use App\Models\Product;
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
        Schema::create('bill_dentails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bill::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->double('don_gia');
            $table->unsignedInteger('quantity');
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_dentails');
    }
};
