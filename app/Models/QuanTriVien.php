<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class QuanTriVien extends Authenticatable
{
    use HasFactory;
    protected $table = 'QuanTriVien';
    protected $primaryKey = 'MaQT';
    public $timestamps = false;
    protected $fillable = [
        'HoTen', 'Email', 'MatKhau' // và các trường khác nếu cần
    ];
}
