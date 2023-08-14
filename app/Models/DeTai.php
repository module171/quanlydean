<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeTai extends Model
{
    
        protected $table = 'DeTai';
        protected $primaryKey = 'MaDeTai';
        public $timestamps = false;
    
        public function giangVien()
        {
            return $this->belongsTo(GiangVien::class, 'MaGV');
        }
    
        public function loaiDeTai()
        {
            return $this->belongsTo(LoaiDeTai::class, 'MaLoai');
        }
    
        public function nienKhoa()
        {
            return $this->belongsTo(NienKhoa::class, 'MaNK');
        }
    
        public function dangKys()
        {
            return $this->hasMany(DangKy::class, 'MaDeTai');
        }
    }
    

