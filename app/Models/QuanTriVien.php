<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanTriVien extends Model
{
    use HasFactory;
    protected $table = 'QuanTriVien';
    protected $primaryKey = 'MaQT';
    public $timestamps = false;
}
