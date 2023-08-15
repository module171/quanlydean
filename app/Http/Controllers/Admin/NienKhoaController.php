<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NienKhoa;
use Illuminate\Http\Request;

class NienKhoaController extends Controller
{
    public function index()
    {
        return view('page.quanlynienkhoa');
    }

    public function getAllNienKhoa()
    {
        $nienkhoas = NienKhoa::all();
        return response()->json($nienkhoas);
    }

    public function store(Request $request)
    {
        $nienkhoa = new NienKhoa();
        $nienkhoa->NamHoc = $request->namHoc;
        $nienkhoa->HocKy = $request->hocKy;
        $nienkhoa->save();

        return response()->json(['message' => 'Thêm niên khóa thành công.']);
    }

    public function edit($id)
    {
        $nienkhoa = NienKhoa::findOrFail($id);
        return response()->json(['nienkhoa' => $nienkhoa]);
    }

    public function update(Request $request)
    {
        $nienkhoa = NienKhoa::findOrFail($request->nienkhoaId);
        $nienkhoa->NamHoc = $request->namHoc;
        $nienkhoa->HocKy = $request->hocKy;
        $nienkhoa->save();

        return response()->json(['message' => 'Cập nhật niên khóa thành công.']);
    }

    public function destroy($id)
    {
        $nienkhoa = NienKhoa::findOrFail($id);
        $nienkhoa->delete();

        return response()->json(['message' => 'Xóa niên khóa thành công.']);
    }
}
