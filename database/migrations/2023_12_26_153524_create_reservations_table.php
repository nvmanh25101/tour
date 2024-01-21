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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name_contact', 50);
            $table->string('phone_contact', 15);
            $table->string('email_contact', 255);
            $table->tinyInteger('status')->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->tinyInteger('number_people');
            $table->tinyInteger('payment_method')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->timestamp('departure_date');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers');
            $table->foreignId('tour_id')->constrained('tours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
