<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\SinhVienImport;
use App\Models\GiangVien;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SinhVien;

class AdminController extends Controller
{
    public function index()
    {
        // Truyền dữ liệu vào view
        $data = [
            'pageTitle' => 'Admin Dashboard',
            'menuItems' => ['Dashboard', 'Users', 'Products'], // Các mục trong sidebar
        ];

        return view('page.quanlysinhvienPage', $data);
    }
    public function getPageGiangvien()
    {
        // Truyền dữ liệu vào view
        $data = [
            'pageTitle' => 'Admin Dashboard',
            'menuItems' => ['Dashboard', 'Users', 'Products'], // Các mục trong sidebar
        ];

        return view('page.quanlygiangvien', $data);
    }
    public function getAllStudent()
    {
        $students = SinhVien::all();
        return response()->json($students);
    }
    public function getAllGiangvien()
    {
        $giangviens = GiangVien::all();
        return response()->json($giangviens);
    }
    public function getgiangvienbyid($id)
    {
        $giangVien = GiangVien::find($id);
        return response()->json(['giangVien' => $giangVien]);
    }
    public function xoagiangvien($id)
    {
        // Tìm giảng viên theo ID
        $giangVien = GiangVien::findOrFail($id);

        // Thực hiện xóa
        $giangVien->delete();

        return response()->json(['message' => 'Xóa giảng viên thành công']);
    }
    public function creategiangvien(Request $request)
    {
        // $giangviens = GiangVien::all();
        // $request->validate([
        //     'HoTen' => 'required|string|max:255',
        //     'Email' => 'required|email|unique:GiangVien,Email',
        //     'MatKhau' => 'required|string|min:6',
        //     'chucVu' => 'required|string|max:255',
        //     'khoa' => 'required|string|max:255',
        //     // Thêm các trường khác tương ứng
        // ]);

        $giangvien = new GiangVien;
        $giangvien->HoTen = $request->input("hoTen");
        $giangvien->Email = $request->input("email");
        $giangvien->MatKhau = bcrypt($request->input("matKhau"));
        $giangvien->ChucVu = $request->input("chucVu");
        $giangvien->Khoa = $request->input('khoa');
        // Thêm các trường còn lại tương ứng
        $result = $giangvien->save();

        if ($result == 1) {
            return response()->json(['message' => 'Thêm giảng viên thành công.'], 200);
        } else {
            return response()->json(['message' => 'Thêm giảng viên thất bại'], 200);
        }
    }

    public function updategiangvien(Request $request)
    {
        // $giangviens = GiangVien::all();
        // $request->validate([
        //     'HoTen' => 'required|string|max:255',
        //     'Email' => 'required|email|unique:GiangVien,Email',
        //     'MatKhau' => 'required|string|min:6',
        //     'chucVu' => 'required|string|max:255',
        //     'khoa' => 'required|string|max:255',
        //     // Thêm các trường khác tương ứng
        // ]);

        $giangvien =  GiangVien::find($request->input("giangVienId"));
        $giangvien->HoTen = $request->input("hoTen");
        $giangvien->Email = $request->input("email");
        $giangvien->MatKhau = bcrypt($request->input("matKhau"));
        $giangvien->ChucVu = $request->input("chucVu");
        $giangvien->Khoa = $request->input('khoa');
        // Thêm các trường còn lại tương ứng
        $result = $giangvien->save();

        if ($result == 1) {
            return response()->json(['message' => 'Thêm giảng viên thành công.'], 200);
        } else {
            return response()->json(['message' => 'Thêm giảng viên thất bại'], 200);
        }
    }
    public function importStudent(Request $request)
    {
        $file = $request->file('excel_file');
        // dd($file);
        if ($file) {
            try {
                $import =  Excel::import(new SinhVienImport(), $file);

                return response()->json(['message' => 'Import thành công.'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Import thất bại: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'Không có tệp được chọn.'], 400);
    }
}
