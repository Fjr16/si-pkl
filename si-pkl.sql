-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si-pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_lists`
--

CREATE TABLE `attendance_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Tidak Hadir') NOT NULL DEFAULT 'Tidak Hadir',
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_lists`
--

INSERT INTO `attendance_lists` (`id`, `student_id`, `jam_masuk`, `jam_pulang`, `status`, `keterangan`, `foto`, `created_at`, `updated_at`) VALUES
(2, 1, '12:00:00', '12:00:00', 'Hadir', 'igffg', 'foto-presensi/qsdzGRwxWgHvbck2vjv5Tk7qb4xoXIYSSj2IYTgp.jpg', '2024-11-19 04:04:29', '2024-11-19 04:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pkl_data_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `pkl_data_id`, `file_path`, `status`, `created_at`, `updated_at`) VALUES
(17, 2, 'sertifikat_pkl/1732449593_signed.pdf', 'approved', '2024-11-24 04:57:55', '2024-11-24 04:59:53'),
(18, 4, 'sertifikat_pkl/1732450346_signed.pdf', 'approved', '2024-11-24 05:12:14', '2024-11-24 05:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

CREATE TABLE `daily_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_laporan` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dudis`
--

CREATE TABLE `dudis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pimpinan` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dudis`
--

INSERT INTO `dudis` (`id`, `user_id`, `pimpinan`, `nip`, `alamat`, `kota`, `no_hp`, `created_at`, `updated_at`) VALUES
(2, 7, 'angga', '12453453456', 'padang', 'padang', '654656879', '2024-11-15 04:59:22', '2024-11-15 04:59:22'),
(4, 10, 'coba', '476256457', 'padang', 'padang', '98835645', '2024-11-15 05:05:56', '2024-11-15 05:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `dudi_major`
--

CREATE TABLE `dudi_major` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dudi_id` bigint(20) UNSIGNED NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dudi_major`
--

INSERT INTO `dudi_major` (`id`, `dudi_id`, `major_id`, `created_at`, `updated_at`) VALUES
(1, 4, 3, NULL, NULL),
(4, 4, 5, NULL, NULL),
(5, 2, 3, NULL, NULL),
(6, 2, 4, NULL, NULL),
(8, 2, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_reports`
--

CREATE TABLE `last_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `last_reports`
--

INSERT INTO `last_reports` (`id`, `student_id`, `tanggal`, `file_name`, `file_path`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-11-20', '1732106461_20190221_SG_TutorHandbook.pdf', 'laporan-akhir-siswa/1732106461_20190221_SG_TutorHandbook.pdf', 4.63, '2024-11-20 05:41:01', '2024-11-20 05:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(3, '01', 'TKJ', '2024-11-14 03:47:37', '2024-11-14 03:47:37'),
(4, '02', 'RPL', '2024-11-15 04:35:41', '2024-11-15 04:35:41'),
(5, '03', 'Listrik', '2024-11-15 04:35:50', '2024-11-15 04:35:50'),
(6, '04', 'Tambang', '2024-11-15 04:35:59', '2024-11-15 04:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_05_123248_create_majors_table', 1),
(5, '2024_10_05_140308_create_teachers_table', 1),
(6, '2024_10_06_082326_create_dudis_table', 1),
(8, '2024_11_15_120159_create_dudi_majors_table', 2),
(9, '2024_11_15_120159_create_dudi_major_table', 3),
(10, '2024_10_06_090939_create_students_table', 4),
(11, '2024_11_16_134231_create_pkl_data_table', 5),
(12, '2024_11_17_143859_create_attendance_lists_table', 6),
(14, '2024_11_19_115401_create_teacher_monitorings_table', 7),
(20, '2024_11_20_113634_create_daily_reports_table', 9),
(21, '2024_11_19_130957_create_last_reports_table', 10),
(22, '2024_11_21_145532_create_certificates_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pkl_data`
--

CREATE TABLE `pkl_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `dudi_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkl_data`
--

INSERT INTO `pkl_data` (`id`, `student_id`, `dudi_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(2, 1, 4, 3, '2024-11-16 07:06:35', '2024-11-19 05:48:08'),
(4, 2, 2, 2, '2024-11-19 05:49:20', '2024-11-19 05:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('w6nPiHUM3ffL8BpdDDTqjwjM5ubD1NpmHVi0cLEb', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEx2cE1meVhoNjEyQWlIUVRhaWdyVGh3ek91VHZTRHBEeFdESVo1MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kdWRpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1732453489);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `major_id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(20) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `tmp_lhr` varchar(255) NOT NULL,
  `tgl_lhr` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `major_id`, `nis`, `jk`, `tmp_lhr`, `tgl_lhr`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(1, 11, 5, '125', 'Perempuan', 'padang', '2024-11-14', 'Jakarta', '987654', '2024-11-15 05:26:16', '2024-11-15 05:28:04'),
(2, 14, 4, '343244', 'Laki-Laki', 'padang', '2019-12-31', 'padang', '96764876458674', '2024-11-19 05:49:03', '2024-11-19 05:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jk` varchar(255) NOT NULL,
  `tmp_lhr` varchar(255) NOT NULL,
  `tgl_lhr` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `bidang_studi` varchar(255) NOT NULL,
  `pend_terakhir` varchar(255) NOT NULL,
  `gol_darah` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `jk`, `tmp_lhr`, `tgl_lhr`, `alamat`, `no_hp`, `golongan`, `bidang_studi`, `pend_terakhir`, `gol_darah`, `jabatan`, `created_at`, `updated_at`) VALUES
(2, 12, 'Laki-Laki', 'padang', '2024-01-01', 'padang', '43653453495', 'D', 'Pend Informatika', 'DIV/S1', 'A', 'ASN', '2024-11-16 06:37:13', '2024-11-16 06:37:13'),
(3, 13, 'Perempuan', 'padang', '2024-12-31', 'padang', '948534857', 'C', 'Elektronika', 'DIV/S1', 'A', 'ASN', '2024-11-16 07:05:25', '2024-11-16 07:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_monitorings`
--

CREATE TABLE `teacher_monitorings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `kejadian` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `dokumentasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_monitorings`
--

INSERT INTO `teacher_monitorings` (`id`, `teacher_id`, `student_id`, `kejadian`, `keterangan`, `tindakan`, `dokumentasi`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'alfa', 'siswa tidak datang ke perusahaan pkl pada hari selasa tgl 11-19-2024', 'sp 1', 'dokumentasi-monitoring/cwwl3SGZDR6hxNI7xxbishmVhdRuipdA8JplBq2l.jpg', '2024-11-19 05:10:26', '2024-11-19 05:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '123', 'Admin', NULL, '$2y$12$OqP.psGPOVl81Cq4VTQfbOvBW4MNQFK6w/GI74klQHcxqpCdF4IKa', NULL, NULL, NULL),
(6, 'siswa1', 'siswa@gmail.com', '45', 'Siswa', NULL, '$2y$12$/3BAy6eLgQdgC27QmSOhMOIs322DS9nrGl5XSmS5TzQXL8crHgWqu', NULL, '2024-11-14 03:48:28', '2024-11-14 03:48:28'),
(7, 'Perusahaan JaJangNam', 'dudi1@gmail.com', 'dudi1', 'DUDI', NULL, '$2y$12$vT3dY9mTTD6qt4Pb6jzDceAFz4kZsSZNAmw4ILkFpqjRgo53H89i.', NULL, '2024-11-15 04:59:22', '2024-11-15 04:59:22'),
(10, 'Perusahaan JaJangNam 2', 'coba@gmail.com', 'coba', 'DUDI', NULL, '$2y$12$r3/IAeU2eDlV9v8PkBAos.ldJvZ/KmpLR1Rz7Lrwq1S7gQgZS1shm', NULL, '2024-11-15 05:05:56', '2024-11-15 05:05:56'),
(11, 'elli', 'ell@gmail.com', 'ell', 'Siswa', NULL, '$2y$12$MLl/0GU07YtuAoEKzTkQyurnbtmX.1yMqvk6JaPWi/bV78y./mg7q', NULL, '2024-11-15 05:26:16', '2024-11-15 05:26:16'),
(12, 'guru 1', 'guru@gmail.com', 'guru1', 'Guru', NULL, '$2y$12$IWNO7OtYEcjvUvYxmstjquLo55b2CXzEJPDZkTzL4kgQ9T6pSzkSi', NULL, '2024-11-16 06:37:13', '2024-11-16 06:37:13'),
(13, 'guru 2', 'guru2@gmail.com', 'guru2', 'Guru', NULL, '$2y$12$XlLJyMjQ/cl6la4E8nLZzu4EJNW4Z3MTTve8nz.Tmk1DpgizKLO5O', NULL, '2024-11-16 07:05:25', '2024-11-16 07:05:25'),
(14, 'siswa 2', 'siswa2@gmail.com', 'siswa2', 'Siswa', NULL, '$2y$12$ChSjpiTHxAkv6EYAbo02TOWF2xFYiDkgAE5Iyf1Y4DC8vRoTwPot.', NULL, '2024-11-19 05:49:03', '2024-11-19 05:49:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_lists`
--
ALTER TABLE `attendance_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dudis`
--
ALTER TABLE `dudis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dudi_major`
--
ALTER TABLE `dudi_major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_reports`
--
ALTER TABLE `last_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pkl_data`
--
ALTER TABLE `pkl_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_monitorings`
--
ALTER TABLE `teacher_monitorings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_lists`
--
ALTER TABLE `attendance_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `daily_reports`
--
ALTER TABLE `daily_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dudis`
--
ALTER TABLE `dudis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dudi_major`
--
ALTER TABLE `dudi_major`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_reports`
--
ALTER TABLE `last_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pkl_data`
--
ALTER TABLE `pkl_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_monitorings`
--
ALTER TABLE `teacher_monitorings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
