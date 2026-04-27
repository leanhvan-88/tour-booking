<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {

            // ❌ bỏ schedule
            $table->dropColumn('schedule');

            // ✅ thêm chuẩn
            $table->text('description')->nullable();
            $table->json('itinerary')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->text('schedule')->nullable();
            $table->dropColumn(['description', 'itinerary']);

        });
    }
};