<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;
    protected $table = 'SinhVien';
    protected $primaryKey = 'MaSV';
    public $timestamps = false;
    protected $fillable = [
        'HoTen','Email','MatKhau','Lop','Khoa','NgaySinh' // và các trường khác nếu cần
    ];
    public function dangKys()
    {
        return $this->hasMany(DangKy::class, 'MaSV');
    }
}
