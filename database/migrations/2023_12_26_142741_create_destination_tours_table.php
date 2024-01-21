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
        Schema::create('destination_tours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('destination_id')->unsigned();
            $table->unsignedBiginteger('tour_id')->unsigned();
            $table->foreign('destination_id')->references('id')
                ->on('destinations')->onDelete('cascade');
            $table->foreign('tour_id')->references('id')
                ->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_tours');
    }
};
