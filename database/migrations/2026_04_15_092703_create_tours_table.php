<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration'); // 4 ngày
            $table->string('departure'); // TP.HCM
            $table->string('destination'); // Đà Nẵng - Hội An - Huế
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->longText('schedule'); // lịch trình chi tiết
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
