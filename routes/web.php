<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoaiDeTaiController;
use App\Http\Controllers\Admin\NienKhoaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/getAllStudent', [AdminController::class, 'getAllStudent'])->name('getAllStudent');
Route::get('/getAllGiangvien', [AdminController::class, 'getAllGiangvien'])->name('getAllGiangvien');
Route::get('/giangvien', [AdminController::class, 'getPageGiangvien'])->name('giangvien');
Route::post('/importStudent', [AdminController::class, 'importStudent'])->name('import.students');
Route::post('/taogiangvien', [AdminController::class, 'creategiangvien'])->name('creategiangvien');
Route::post('/updategiangvien', [AdminController::class, 'updategiangvien'])->name('updategiangvien');
Route::get('/giangvien/{id}', [AdminController::class, 'getgiangvienbyid'])->name('giangvien.show');
Route::delete('/xoagiangvien/{id}', [AdminController::class, 'xoagiangvien'])->name('xoagiangvien');


Route::get('/loaidetai', [LoaiDeTaiController::class, 'index'])->name('loaidetai');
Route::get('/getAllLoaiDetai', [LoaiDeTaiController::class, 'getAllLoaiDetai'])->name('getAllLoaiDetai');
Route::post('taoloaidetai', [LoaiDeTaiController::class, 'store'])->name('taoloaidetai');
Route::post('updateloaidetai', [LoaiDeTaiController::class, 'update'])->name('updateloaidetai');
Route::get('/loaidetai/{id}', [LoaiDeTaiController::class, 'edit'])->name('loaidetai.show');
Route::delete('/xoaloaidetai/{id}', [LoaiDeTaiController::class, 'destroy'])->name('xoaloaidetai');



Route::get('/namhoc', [NienKhoaController::class, 'index'])->name('namhoc');
Route::get('/getAllNienKhoa', [NienKhoaController::class, 'getAllNienKhoa'])->name('getAllNienKhoa');
Route::post('taoNienKhoa', [NienKhoaController::class, 'store'])->name('taoNienKhoa');
Route::post('updateNienKhoa', [NienKhoaController::class, 'update'])->name('updateNienKhoa');
Route::get('/namhoc/{id}', [NienKhoaController::class, 'edit'])->name('namhoc.show');
Route::delete('/xoaNienKhoa/{id}', [NienKhoaController::class, 'destroy'])->name('xoaNienKhoa');
