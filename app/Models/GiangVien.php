<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    use HasFactory;
    protected $table = 'GiangVien';
    protected $primaryKey = 'MaGV';
    public $timestamps = false;

    public function deTais()
    {
        return $this->hasMany(DeTai::class, 'MaGV');
    }
}
