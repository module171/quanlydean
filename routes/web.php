<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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
Route::post('importStudent', [AdminController::class, 'importStudent'])->name('import.students');
