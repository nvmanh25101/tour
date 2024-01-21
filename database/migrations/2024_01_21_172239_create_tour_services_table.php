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
        Schema::create('tour_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('service_id')->unsigned();
            $table->unsignedBiginteger('tour_id')->unsigned();
            $table->foreign('service_id')->references('id')
                ->on('services')->onDelete('cascade');
            $table->foreign('tour_id')->references('id')
                ->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_services');
    }
};
