<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKy extends Model
{
    use HasFactory;
    protected $table = 'DangKy';
    protected $primaryKey = 'MaDK';
    public $timestamps = false;

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'MaSV');
    }

    public function deTai()
    {
        return $this->belongsTo(DeTai::class, 'MaDeTai');
    }
}
