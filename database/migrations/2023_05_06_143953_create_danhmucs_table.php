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
        Schema::create('danhmucs', function (Blueprint $table) {
            $table->id();
            $table->string('TenDM',255); // 255 ở đây là độ dài của trường dữ liệu
            $table->string('MaDM');
            $table->longText('MoTa'); // Vì mô tả có thể nhập được nhiều thông tin
            $table->string('ViTri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmucs');
    }
};
