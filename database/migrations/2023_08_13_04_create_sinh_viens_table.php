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
        Schema::create('SinhVien', function (Blueprint $table) {
            $table->increments('MaSV');
            $table->string('HoTen');
            $table->string('Email');
            $table->string('MatKhau');
            $table->string('Lop');
            $table->string('Khoa');
            $table->date('NgaySinh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SinhVien');
    }
};
