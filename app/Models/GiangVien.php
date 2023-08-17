<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class GiangVien extends Authenticatable
{
    use HasFactory;
    protected $table = 'GiangVien';
    protected $primaryKey = 'MaGV';
    public $timestamps = false;
    protected $fillable = [
        'HoTen', 'Email', 'MatKhau', 'Lop', 'ChucVu', 'Khoa' // và các trường khác nếu cần
    ];
    public function deTais()
    {
        return $this->hasMany(DeTai::class, 'MaGV');
    }
    protected $casts = [

        'MatKhau' => 'hashed',
    ];
}
