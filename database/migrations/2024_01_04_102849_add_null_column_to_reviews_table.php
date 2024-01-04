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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_admin_id_foreign');
            $table->foreignId('admin_id')->nullable()->change()->constrained('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'admin_id')) {
                Schema::table('reviews', function (Blueprint $table) {
                    $table->dropColumn('admin_id');
                });
            }
        });
    }
};
