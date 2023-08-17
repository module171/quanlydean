-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 18, 2023 lúc 01:34 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydean`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangky`
--

CREATE TABLE `dangky` (
  `MaDK` int(10) UNSIGNED NOT NULL,
  `MaSV` int(10) UNSIGNED NOT NULL,
  `MaDeTai` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detai`
--

CREATE TABLE `detai` (
  `MaDeTai` int(10) UNSIGNED NOT NULL,
  `TenDeTai` varchar(255) NOT NULL,
  `MaGV` int(10) UNSIGNED NOT NULL,
  `MaLoai` int(10) UNSIGNED NOT NULL,
  `MaNK` int(10) UNSIGNED NOT NULL,
  `SoLuongSV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` int(10) UNSIGNED NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `ChucVu` varchar(255) NOT NULL,
  `Khoa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `HoTen`, `Email`, `MatKhau`, `ChucVu`, `Khoa`) VALUES
(3, 'NGUYEN VAN A', 'test@test.com', '$2y$10$kPfbtSnMRmT86Fnd5N2toe1TJ2msWQ5aIPwaSvkBpZqhYfPv5.XhW', 'giang vien', 'CNTT'),
(4, 'NGUYEN VAN B', 'test171@test.com', '$2y$10$RIhzR2a1y4KpngVuiqurB.k2XGt8DJnWd72NhEoU/QfRkomgQnrYC', 'giang vien', 'CNTT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaidetai`
--

CREATE TABLE `loaidetai` (
  `MaLoai` int(10) UNSIGNED NOT NULL,
  `TenLoai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaidetai`
--

INSERT INTO `loaidetai` (`MaLoai`, `TenLoai`) VALUES
(2, 'hoc ky 2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_13_01_create_quan_tri_viens_table', 1),
(6, '2023_08_13_02_create_loai_de_tais_table', 1),
(7, '2023_08_13_04_create_sinh_viens_table', 1),
(8, '2023_08_13_05_create_giang_viens_table', 1),
(9, '2023_08_13_06_create_nien_khoas_table', 1),
(10, '2023_08_13_10_create_de_tais_table', 1),
(11, '2023_08_13_11_create_dang_kys_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nienkhoa`
--

CREATE TABLE `nienkhoa` (
  `MaNK` int(10) UNSIGNED NOT NULL,
  `NamHoc` varchar(255) NOT NULL,
  `HocKy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nienkhoa`
--

INSERT INTO `nienkhoa` (`MaNK`, `NamHoc`, `HocKy`) VALUES
(1, '2022', 'Học kỳ 1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantrivien`
--

CREATE TABLE `quantrivien` (
  `MaQT` int(10) UNSIGNED NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quantrivien`
--

INSERT INTO `quantrivien` (`MaQT`, `HoTen`, `Email`, `MatKhau`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$3bUw0rV3JO5WMD0kdJjc9uewP5NBGNLooS8KAxpgZXL0tSQ7H6n8O');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` int(10) UNSIGNED NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Lop` varchar(255) NOT NULL,
  `Khoa` varchar(255) NOT NULL,
  `NgaySinh` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `HoTen`, `Email`, `MatKhau`, `Lop`, `Khoa`, `NgaySinh`) VALUES
(1, 'nguyen van a', 'abc@gmail.com', '$2y$10$yNZCSVNjpTsTo81d.84qD.WTRIDXlvCEKDhHRr8FpIVJ.Ro/SujQK', 'KTPM', 'CNTT', '2000-01-01'),
(2, 'nguyen van a', 'abc@gmail.com', '$2y$10$mP8fXD3Bw3JBwoHhrkugdOt9uwYqau4q5/9n1IDlgpJ8Tdr1yu2X.', 'KTPM', 'CNTT', '2000-01-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dangky`
--
ALTER TABLE `dangky`
  ADD PRIMARY KEY (`MaDK`),
  ADD KEY `dangky_masv_foreign` (`MaSV`),
  ADD KEY `dangky_madetai_foreign` (`MaDeTai`);

--
-- Chỉ mục cho bảng `detai`
--
ALTER TABLE `detai`
  ADD PRIMARY KEY (`MaDeTai`),
  ADD KEY `detai_magv_foreign` (`MaGV`),
  ADD KEY `detai_maloai_foreign` (`MaLoai`),
  ADD KEY `detai_mank_foreign` (`MaNK`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`);

--
-- Chỉ mục cho bảng `loaidetai`
--
ALTER TABLE `loaidetai`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nienkhoa`
--
ALTER TABLE `nienkhoa`
  ADD PRIMARY KEY (`MaNK`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  ADD PRIMARY KEY (`MaQT`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dangky`
--
ALTER TABLE `dangky`
  MODIFY `MaDK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `detai`
--
ALTER TABLE `detai`
  MODIFY `MaDeTai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `MaGV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loaidetai`
--
ALTER TABLE `loaidetai`
  MODIFY `MaLoai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nienkhoa`
--
ALTER TABLE `nienkhoa`
  MODIFY `MaNK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  MODIFY `MaQT` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `MaSV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dangky`
--
ALTER TABLE `dangky`
  ADD CONSTRAINT `dangky_madetai_foreign` FOREIGN KEY (`MaDeTai`) REFERENCES `detai` (`MaDeTai`),
  ADD CONSTRAINT `dangky_masv_foreign` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Các ràng buộc cho bảng `detai`
--
ALTER TABLE `detai`
  ADD CONSTRAINT `detai_magv_foreign` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `detai_maloai_foreign` FOREIGN KEY (`MaLoai`) REFERENCES `loaidetai` (`MaLoai`),
  ADD CONSTRAINT `detai_mank_foreign` FOREIGN KEY (`MaNK`) REFERENCES `nienkhoa` (`MaNK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
