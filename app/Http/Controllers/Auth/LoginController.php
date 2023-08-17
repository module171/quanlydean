<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GiangVien;
use App\Models\QuanTriVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function logoutgiangvien()
    {
        Auth::guard('giangvien')->logout();


        return redirect('/login');
    }
    public function logoutquantrivien()
    {
        Auth::guard('quantrivien')->logout();


        return redirect('/login');
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
        ];

        $giangVien = GiangVien::where('Email', $credentials['email'])->first();

        if ($giangVien && Hash::check($request->input('password'), $giangVien->MatKhau)) {
            Auth::guard('giangvien')->login($giangVien);
            return redirect()->intended('/');
            // Xác thực thành công
        }
        $quantrivien = QuanTriVien::where('Email', $credentials['email'])->first();
        if ($quantrivien && Hash::check($request->input('password'), $quantrivien->MatKhau)) {
            Auth::guard('quantrivien')->login($quantrivien);
            return redirect()->intended('admin/');
        }

        // Đăng nhập thất bại
        return redirect()->route('login')->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác',
        ]);
    }
}
