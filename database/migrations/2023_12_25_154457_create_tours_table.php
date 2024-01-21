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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 255);
            $table->text('description');
            $table->text('price_include');
            $table->text('price_exclude');
            $table->text('price_children')->nullable();
            $table->text('note');
            $table->string('image', 255);
            $table->string('departure_time', 255);
            $table->string('duration', 255);
            $table->tinyInteger('vehicle');
            $table->tinyInteger('status')->default(1);
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('admin_id')->constrained('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
