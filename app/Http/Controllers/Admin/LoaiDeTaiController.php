<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoaiDeTai;
use Illuminate\Http\Request;

class LoaiDeTaiController extends Controller
{
    public function index()
    {

        return view('page.quanlyloaidetai');
    }

    public function create()
    {
        return view('loaidean.create');
    }
    public function getAllLoaiDetai()
    {
        $detais = LoaiDeTai::all();
        return response()->json($detais);
    }
    public function store(Request $request)
    {
        $loaidean = new LoaiDeTai();
        $loaidean->TenLoai = $request->tenLoai;
        $loaidean->save();

        return response()->json(['message' => 'Thêm loại đề tài thành công.']);
    }

    public function edit($id)
    {
        $loaidean = LoaiDeTai::findOrFail($id);
        return response()->json(['detai' => $loaidean]);
    }

    public function update(Request $request)
    {
        $loaidean = LoaiDeTai::findOrFail($request->loaidetaiId);
        $loaidean->TenLoai = $request->tenLoai;
        $loaidean->save();

        return response()->json(['message' => 'Cập nhật loại đề tài thành công.']);
    }

    public function destroy($id)
    {
        $loaidean = LoaiDeTai::findOrFail($id);
        $loaidean->delete();

        return response()->json(['message' => 'Xóa loại đề tài thành công.']);
    }
}
