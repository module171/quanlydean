<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\SinhVienImport;
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
    public function getAllStudent()
    {
        $students = SinhVien::all();
        return response()->json($students);
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
