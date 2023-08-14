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
        Schema::create('DeTai', function (Blueprint $table) {
            $table->increments('MaDeTai');
            $table->string('TenDeTai');
            $table->unsignedInteger('MaGV');
            $table->unsignedInteger('MaLoai');
            $table->unsignedInteger('MaNK');
            $table->integer('SoLuongSV');
            $table->foreign('MaGV')->references('MaGV')->on('GiangVien');
            $table->foreign('MaLoai')->references('MaLoai')->on('LoaiDeTai');
            $table->foreign('MaNK')->references('MaNK')->on('NienKhoa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DeTai');
    }
};
