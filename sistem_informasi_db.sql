-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2023 pada 17.57
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `divitions`
--

CREATE TABLE `divitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divitions`
--

INSERT INTO `divitions` (`id`, `name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Dishub Kodam IM', 3, NULL, NULL),
(2, 'Dev Bataliyon 1', 2, NULL, NULL),
(3, 'Dev Bataliyon 2-N', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('Laki - Laki','Perempuan') NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gol` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `divisi` int(11) NOT NULL DEFAULT 1,
  `pimpinan` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `nip`, `nama`, `jk`, `jabatan`, `status`, `gol`, `alamat`, `divisi`, `pimpinan`, `image`, `created_at`, `updated_at`) VALUES
(1, '1123152203980115', 'Administrator', 'Laki - Laki', 'Pasi Ops', 'PNS', 'Letda Inf', 'Sabang', 1, NULL, 'user/RJpthe9QWmB3wJRll6iaVVGok7HeQIKo2QuvzC1T.jpg', '2023-03-03 06:37:09', '2023-03-10 07:27:50'),
(2, '11', 'Andrian', 'Laki - Laki', 'Kabid Kepegawaian', 'PNS', 'III/B', 'Banda Aceh', 1, 1, 'user/205p83m1G7V1bgqbXD2bIN70Ne3rFKSxEg3jr3jU.jpg', '2023-03-10 07:06:22', '2023-03-10 07:06:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_barang` varchar(255) NOT NULL,
  `nm_barang` varchar(255) NOT NULL,
  `mrk_barang` varchar(255) NOT NULL,
  `jml_barang` double NOT NULL,
  `tahun_barang` int(11) NOT NULL,
  `harga_barang` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_distributions`
--

CREATE TABLE `item_distributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kondisi_barang` varchar(255) DEFAULT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `status` enum('masuk','keluar') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_servies`
--

CREATE TABLE `item_servies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` double NOT NULL,
  `kondisi_barang` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_servis` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status_servis` varchar(255) NOT NULL,
  `jenis_servis` varchar(255) NOT NULL,
  `harga_servis` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_stocks`
--

CREATE TABLE `item_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stock_barang` int(11) NOT NULL,
  `jumlah_barang_bagus` int(11) NOT NULL,
  `jumlah_barang_tidak_bagus` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_20_164346_data_barang', 1),
(6, '2022_12_21_065108_create_item_servies_table', 1),
(7, '2022_12_21_090312_create_item_distributions_table', 1),
(8, '2022_12_22_150731_create_item_stocks_table', 1),
(9, '2022_12_24_122714_create_employees_table', 1),
(10, '2022_12_30_134636_upload_file', 1),
(11, '2023_01_02_121724_create_user_roles_table', 1),
(12, '2023_01_02_121825_create_divitions_table', 1),
(13, '2023_01_03_104749_create_news_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `type` enum('Profil','Pengumuman') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `header`, `slug`, `image`, `body`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit.', 'news/U6vqrtgMFdZNhh69Lvnu3XV6yWyWdU12knHHSNDk.jpg', '<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.<br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.<br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.</div>', 'Profil', '2023-03-10 07:09:27', '2023-03-10 07:09:27'),
(2, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque, aspernatur!', 'lorem,-ipsum-dolor-sit-amet-consectetur-adipisicing-elit.-cumque,-aspernatur!', 'news/hyWAOrFQD1Eh6ovQaSarnMse03HwLYdSFcTBBTpR.jpg', '<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.<br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.<br><br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis iusto, ea earum, temporibus distinctio consectetur ipsa eligendi repellat corporis fugit commodi enim nemo eaque dolorum id debitis illo recusandae. Temporibus qui iusto exercitationem dolorem, fuga tempora neque laudantium architecto minus reprehenderit odio similique tempore recusandae porro nesciunt eaque corporis commodi.</div>', 'Pengumuman', '2023-03-10 07:10:58', '2023-03-10 07:10:58'),
(3, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque, aspernatur!', 'lorem,-ipsum-dolor-sit-amet-consectetur-adipisicing-elit.-cumque,-aspernatur!', 'news/9679fs5LXSFwpukxu5KN7lT25gu2lkgUG3rd53wH.jpg', '<div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto dolorum quis, non explicabo iusto culpa error similique accusantium blanditiis dicta, aliquid tempore ullam exercitationem! Nesciunt quis ipsam accusantium accusamus ut ad fugiat nulla vero corporis exercitationem placeat, doloribus, vitae error sit perspiciatis, minima tempore voluptatem blanditiis rem quisquam! Quas fuga necessitatibus ut alias laborum illum facilis sapiente error ducimus! Pariatur!<br><br>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto dolorum quis, non explicabo iusto culpa error similique accusantium blanditiis dicta, aliquid tempore ullam exercitationem! Nesciunt quis ipsam accusantium accusamus ut ad fugiat nulla vero corporis exercitationem placeat, doloribus, vitae error sit perspiciatis, minima tempore voluptatem blanditiis rem quisquam! Quas fuga necessitatibus ut alias laborum illum facilis sapiente error ducimus! Pariatur!<br><br>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto dolorum quis, non explicabo iusto culpa error similique accusantium blanditiis dicta, aliquid tempore ullam exercitationem! Nesciunt quis ipsam accusantium accusamus ut ad fugiat nulla vero corporis exercitationem placeat, doloribus, vitae error sit perspiciatis, minima tempore voluptatem blanditiis rem quisquam! Quas fuga necessitatibus ut alias laborum illum facilis sapiente error ducimus! Pariatur!</div>', 'Pengumuman', '2023-03-10 07:12:32', '2023-03-10 07:12:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload_files`
--

CREATE TABLE `upload_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `id_pegawai`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin1234', 'admin1234@gmail.com', '$2y$10$g5Ppr3D.aYIAoKN1cePvFOmLhVEqLkwY.SY.0jm32RZC.8/zpwYYG', 1, 1, '2023-03-03 06:19:48', '2023-03-03 06:37:09'),
(2, 'Devisi Bataliyon 1', 'bataliyon1234', 'bataliyon1234@gmail.com', '$2y$10$Uf3LEOkNBdxKgDciUPpH1uSdVldVcLMEkDh4DLq4xuRdTMflUbmMq', 2, NULL, '2023-03-03 06:19:48', '2023-03-03 06:19:48'),
(3, 'User Dishub Kodam', 'user1234', 'user1234@gmail.com', '$2y$10$lVM3rxyIvX8EHDC8Ux/vE.Uv116I3hLo.UbPTLUyI3f/9zTCADi4y', 3, NULL, '2023-03-03 06:19:48', '2023-03-03 06:19:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Devisi', NULL, NULL),
(3, 'User', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `divitions`
--
ALTER TABLE `divitions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_distributions`
--
ALTER TABLE `item_distributions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_servies`
--
ALTER TABLE `item_servies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_stocks`
--
ALTER TABLE `item_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `upload_files`
--
ALTER TABLE `upload_files`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `divitions`
--
ALTER TABLE `divitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item_distributions`
--
ALTER TABLE `item_distributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item_servies`
--
ALTER TABLE `item_servies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `item_stocks`
--
ALTER TABLE `item_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `upload_files`
--
ALTER TABLE `upload_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
