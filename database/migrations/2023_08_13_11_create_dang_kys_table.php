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
        Schema::create('DangKy', function (Blueprint $table) {
            $table->increments('MaDK');
            $table->unsignedInteger('MaSV');
            $table->unsignedInteger('MaDeTai');
            $table->foreign('MaSV')->references('MaSV')->on('SinhVien');
            $table->foreign('MaDeTai')->references('MaDeTai')->on('DeTai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DangKy');
    }
};
