<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name_receiver', 50);
            $table->string('phone_receiver', 15);
            $table->string('address_receiver', 255);
            $table->tinyInteger('status')->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->tinyInteger('payment_method');
            $table->tinyInteger('payment_status')->default(0);
            $table->timestamp('delivered_at')->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers');
            $table->foreignId('cart_id')->constrained('carts');
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
