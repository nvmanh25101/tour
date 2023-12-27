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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name_booker', 50);
            $table->string('email_booker', 50);
            $table->string('phone_booker', 15);
            $table->tinyInteger('number_people');
            $table->tinyInteger('status')->default(0);
            $table->text('note')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('time_id')->constrained('times');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
