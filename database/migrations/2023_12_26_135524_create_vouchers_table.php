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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->unique();
            $table->string('name', 255);
            $table->tinyInteger('type');
            $table->decimal('value', 10, 2);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->decimal('min_spend', 10, 2);
            $table->integer('uses_per_customer');
            $table->integer('uses_per_voucher');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('applicable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
