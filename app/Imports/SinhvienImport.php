<?php

namespace App\Imports;

use App\Models\SinhVien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
class SinhvienImport implements ToModel, WithHeadingRow, WithMapping
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SinhVien([
            'HoTen' => $row['ho_ten'], // Tên cột trong file Excel là 'ho_ten'
            'Email' => $row['email'],   // Tên cột trong file Excel là 'email'
            'MatKhau' => bcrypt($row['mat_khau']), // Mã hóa mật khẩu
            'Lop' => $row['lop'],
            'Khoa' => $row['khoa'],
            'NgaySinh' => $row['ngay_sinh'],
        ]);
    }
    public function map($row): array
    {
        return [
            'ho_ten' => $row['ho_ten'],
            'email' => $row['email'],
            'mat_khau' => bcrypt($row['mat_khau']),
            'lop' => $row['lop'],
            'khoa' => $row['khoa'],
            'ngay_sinh' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh'])->format('Y-m-d'),
        ];
    }
}
