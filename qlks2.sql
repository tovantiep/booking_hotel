-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 04:00 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlks2`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdp`
--

CREATE TABLE `chitietdp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datphong_id` bigint(20) UNSIGNED NOT NULL,
  `phong_id` bigint(20) UNSIGNED NOT NULL,
  `sophong` bigint(20) NOT NULL DEFAULT 0,
  `so_phong` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `gia` float NOT NULL,
  `chuthich` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `datphong`
--

CREATE TABLE `datphong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ngaydat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tongsophong` int(11) NOT NULL,
  `tongtien` float NOT NULL,
  `start_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `songay` int(11) NOT NULL,
  `chuthich` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trang_thai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datphong_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` int(11) DEFAULT NULL,
  `ngaythanhtoan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tienphong` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kh`
--

CREATE TABLE `kh` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_cmnd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kh`
--

INSERT INTO `kh` (`id`, `user_id`, `sdt`, `dia_chi`, `gioi_tinh`, `so_cmnd`, `ngaysinh`, `created_at`, `updated_at`) VALUES
(3, 12, '01234567891', 'Thái Bình', '1', '0123456789', '2021-05-14', '2021-05-24 12:46:11', '2021-05-24 13:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `loaiphong`
--

CREATE TABLE `loaiphong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenloaiphong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loaiphong`
--

INSERT INTO `loaiphong` (`id`, `tenloaiphong`, `slug`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'Phòng V.I.P', 'phong-vip', 1, '2020-11-20 12:00:31', '2020-11-20 12:00:31'),
(8, 'Phòng Thường', 'phong-thuong', 1, '2020-12-21 04:55:41', '2020-12-21 04:55:41'),
(9, 'Phòng Luxury', 'phong-luxury', 1, '2020-12-21 04:55:47', '2020-12-21 04:55:47'),
(10, 'PHÒNG SIÊU vIP', 'phong-sieu-vip', 1, '2021-01-06 00:58:28', '2021-01-06 00:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2020_11_13_212745_role', 1),
(13, '2020_11_13_212856_loaiphong_table', 1),
(14, '2020_11_13_212913_phong_table', 1),
(15, '2020_11_13_212936_datphong_table', 1),
(16, '2020_11_13_212947_chitietdatphong_table', 2),
(17, '2020_11_13_213009_khachhang_table', 3),
(18, '2020_11_20_205230_slide_table', 4),
(19, '2021_05_24_185916_khach_hang2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loaiphong_id` bigint(20) UNSIGNED NOT NULL,
  `tenphong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chuthich` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinhanh` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `soluong` bigint(20) NOT NULL DEFAULT 0,
  `gia` float NOT NULL,
  `slug` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booked` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`id`, `loaiphong_id`, `tenphong`, `chuthich`, `hinhanh`, `user_id`, `soluong`, `gia`, `slug`, `booked`, `created_at`, `updated_at`) VALUES
(1, 9, 'Phòng Deluxe King', 'Với phòng Deluxe King quý khách sẽ được thưởng thức trọn vẹn vẻ ngay trong phòng ngủ của mình.', 'ZXris_nVjFu_duluxe1.jpg', 1, 5, 1500000, 'phong-deluxe-king', 0, NULL, '2021-05-25 11:50:55'),
(2, 9, 'Phòng Deluxe Twin', 'Phòng Deluxe sẽ giúp quý khách quên đi sự mệt mỏi của cuộc sống vội vã ngoài kia.', 'Ae1lZ_XOm2L_1.jpg', 1, 5, 3000000, 'phong-deluxe-twin', 0, NULL, '2021-05-27 10:27:05'),
(5, 6, 'Phòng Grand Suite', 'Phòng Grand Suite với sofa thư giãn, bồn tắm sụcvà một phòng ngủ giường đôi, sang trọng.', 'N5BCR_lf1fM_suites2.png', 1, 5, 1200000, 'phong-grand-suite', 0, '2020-11-20 11:30:26', '2021-06-02 08:04:37'),
(7, 8, 'Phòng Superior Twin', 'Cảm nhận sự thư giãn và thoải mái với phòng Superior Twin với phong cách trang trí đương đại độc đáo', 'bedna_xDgpz_twin.jpg', 1, 5, 2500000, 'phong-superior-twin', 0, '2020-11-20 12:47:31', '2021-05-27 03:46:36'),
(10, 6, 'Phòng 12 [V.I.P]', 'Phòng Grand Suite với sofa thư giãn, bồn tắm sụcvà một phòng ngủ giường đôi, sang trọng.', 'dVT5L_EXFFL_1.jpg', 1, 5, 4500000, 'phong-12-[v.i.p]', 0, '2020-11-20 13:12:50', '2021-05-31 11:35:10'),
(20, 8, 'Phòng Superior Triple', 'Là sự lựa chọn tốt nhất cho chuyến du lịch với đồng nghiệp, bạn bè hoặc gia đình', 'e8lv1_kEa9z_triple.jpg', 1, 5, 1500000, 'phong-superior-triple', 0, '2020-12-22 11:45:11', '2021-05-26 10:56:46'),
(22, 8, 'Phòng Apartment', 'Phòng căn hộ sang trọng và rộng rãi có 2 tầng trong đó có 3 phòng ngủ giường to.', 'YqaTJ_FQdzG_triple2.jpg', 1, 5, 900000, 'phong-apartment', 0, '2021-01-01 11:52:12', '2021-05-25 11:44:18'),
(23, 8, 'Phòng Thường 123', NULL, 'SnXnn_wxCsm_1.jpg', 1, 5, 1234570, 'phong-thuong-123', 0, '2021-01-06 00:46:20', '2021-05-27 10:21:49'),
(24, 8, 'Phòng 1010', NULL, '03T3P_SgfP7_temp_auto_x2.jpg', 1, 5, 1500000, 'phong-1010', 0, '2021-06-02 08:13:49', '2021-06-02 08:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Quản lý', NULL, NULL),
(3, 'Nhân viên', NULL, NULL),
(4, 'Khách hàng', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tieude` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noidung` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `hinh`, `tieude`, `noidung`, `created_at`, `updated_at`) VALUES
(7, 'qfs7W_HyKNT_111.jpg', 'Bảo Ngọc Hotel', 'Chào mừng bạn đến với Bảo Ngọc Hotel', '2021-05-21 11:38:43', '2021-05-21 11:42:13'),
(8, 'KCKjp_NUsfm_222.jpg', 'LIỆN HỆ VỚI CHÚNG TÔI', 'Hãy liên hệ với chúng tôi, để được nhận những dịch vụ và ưu đãi tốt nhất', '2021-05-21 11:38:57', '2021-05-21 11:38:57'),
(9, 'dfa31_Uscab_333.jpg', 'VỀ CHÚNG TÔI', 'Tìm hiểU về chúng tôi để có chúng ta hiểu nhau hơn', '2021-05-21 11:39:11', '2021-05-21 11:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `sophong`
--

CREATE TABLE `sophong` (
  `id` int(11) NOT NULL,
  `phong_id` int(11) DEFAULT NULL,
  `so_phong` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chitietdp_id` int(11) DEFAULT 0,
  `trang_thai` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_nv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `gioitinh` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `ma_nv`, `role_id`, `gioitinh`, `sdt`, `ngaysinh`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, '$2y$10$U2Zgj7aSOGZN0muYMlnKfuj9geGQ7I9HEJrN2bwISZCql.7nBLYK6', '', 1, 'Nam', '12345678', '2000-12-20', NULL, NULL, '2021-05-25 12:45:09'),
(12, 'Tiến Anh', 'romcoca251100@gmail.com', NULL, '$2y$10$yqaK5t4zWJ/Kxt907PPq5OXpI7qE7AF.kYcgQ0QsKAJz8QZZnzOw2', '', 4, NULL, NULL, NULL, NULL, '2021-05-24 12:46:10', '2021-05-25 12:40:19'),
(13, 'Nguyễn Tiến Anh', 'romcoca201200@gmail.com', NULL, '$2y$10$DXCzn2KW7EigvLfVhtmu5u6nKgFLvMM76xUhA.1UnGyOWs6vgpI6i', '1234546', 2, NULL, NULL, NULL, NULL, '2021-05-25 12:49:57', '2021-05-25 12:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdp`
--
ALTER TABLE `chitietdp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datphong`
--
ALTER TABLE `datphong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kh`
--
ALTER TABLE `kh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loaiphong`
--
ALTER TABLE `loaiphong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sophong`
--
ALTER TABLE `sophong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdp`
--
ALTER TABLE `chitietdp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `datphong`
--
ALTER TABLE `datphong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kh`
--
ALTER TABLE `kh`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loaiphong`
--
ALTER TABLE `loaiphong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sophong`
--
ALTER TABLE `sophong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
