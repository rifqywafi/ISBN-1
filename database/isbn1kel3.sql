-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2024 pada 11.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isbn1kel3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `buku_id` int(255) NOT NULL,
  `buku_judul` varchar(255) NOT NULL,
  `buku_tahun` varchar(255) NOT NULL,
  `buku_penulis` varchar(255) NOT NULL,
  `buku_status` enum('Menunggu Diproses','Sedang Diproses','Sedang Diajukan','Selesai','Ditolak') NOT NULL,
  `pengaju_id` int(255) DEFAULT NULL,
  `staf_id` int(255) DEFAULT NULL,
  `editor_id` int(255) DEFAULT NULL,
  `buku_dokumen` text NOT NULL,
  `buku_tanggal_pengajuan` timestamp NULL DEFAULT current_timestamp(),
  `buku_isbn` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`buku_id`, `buku_judul`, `buku_tahun`, `buku_penulis`, `buku_status`, `pengaju_id`, `staf_id`, `editor_id`, `buku_dokumen`, `buku_tanggal_pengajuan`, `buku_isbn`) VALUES
(24, 'hujan turun', '2023', 'rifqy', 'Selesai', 15, 13, 2, '133546678_Cover Laprak BPW.docx.pdf', '2024-07-21 08:12:39', '1886210845_RobloxScreenShot20231008_230917290.png'),
(26, 'Waw', '2019', 'Rifqyeeqq', 'Selesai', 12, 4, 10, '1383272464_Individual Presentation Assignment - Noval Nugraha 1 TI E.pdf', '2024-07-21 08:12:39', '863348967_194327410_download-removebg-preview (3) (1).png'),
(29, 'Wawe', '2019', 'Rifqy', 'Selesai', 12, 14, 1, '1417289744_Brown and Yellow Scrapbook Brainstorm Presentation_compressed.pdf', '2024-07-21 14:13:06', '1035164021_1568879874_download-removebg-preview (1).png'),
(30, 'QEE', '2134', 'Rifqy', 'Ditolak', 12, NULL, NULL, '967959676_Cover Laprak BPW.docx.pdf', '2024-07-21 14:13:23', NULL),
(33, 'Cahaya', '2022', 'Rifqy', 'Sedang Diajukan', 12, 15, 8, '685044465_35945-91679-1-PB.pdf', '2024-07-22 04:17:02', NULL),
(44, 'Fikri si pengaju', '2024', 'fikrialhashif', 'Sedang Diproses', 19, 17, 3, '691029564_SPESIFIKASI KEBUTUHAN PERANGKAT LUNAK - Kel3 (1).pdf', '2024-07-26 01:22:29', NULL),
(45, 'Senja ditepi danaui', '2024', 'fikrialhashif', 'Sedang Diproses', 19, 17, 1, '470313877_P15. Requirement System Kel3 (ISBN 1).pdf', '2024-07-26 01:26:16', NULL),
(47, 'Takana Juo', '2019', 'RIFQY WAFIANERDZA', 'Menunggu Diproses', 25, NULL, NULL, '1443341883_35945-91679-1-PB.pdf', '2024-07-27 09:21:55', NULL);

--
-- Trigger `buku`
--
DELIMITER $$
CREATE TRIGGER `update_editor_status_diajukan` AFTER UPDATE ON `buku` FOR EACH ROW BEGIN
    IF NEW.buku_status = 'Sedang Diproses' THEN
        UPDATE editor
        SET editor_status_pengerjaan = 'Ada'
        WHERE editor_id = NEW.editor_id;
    ELSEIF NEW.buku_status = 'Sedang Diajukan' THEN
        UPDATE editor
        SET editor_status_pengerjaan = 'Tidak Ada'
        WHERE editor_id = OLD.editor_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `bukujoin`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `bukujoin` (
`buku_id` int(255)
,`buku_judul` varchar(255)
,`buku_tahun` varchar(255)
,`buku_penulis` varchar(255)
,`buku_status` enum('Menunggu Diproses','Sedang Diproses','Sedang Diajukan','Selesai','Ditolak')
,`buku_dokumen` text
,`buku_tanggal_pengajuan` timestamp
,`buku_isbn` text
,`pengaju_id` int(255)
,`pengaju_nama` varchar(255)
,`staf_id` int(255)
,`staf_nama` varchar(255)
,`editor_id` int(255)
,`editor_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `editor`
--

CREATE TABLE `editor` (
  `editor_id` int(255) NOT NULL,
  `editor_nama` varchar(255) NOT NULL,
  `editor_email` varchar(255) NOT NULL,
  `editor_pass` varchar(255) NOT NULL,
  `editor_jk` varchar(255) NOT NULL,
  `editor_noTlp` varchar(20) NOT NULL,
  `editor_status_pengerjaan` enum('Ada','Tidak Ada','','') NOT NULL DEFAULT 'Tidak Ada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `editor`
--

INSERT INTO `editor` (`editor_id`, `editor_nama`, `editor_email`, `editor_pass`, `editor_jk`, `editor_noTlp`, `editor_status_pengerjaan`) VALUES
(1, 'tari', 'tari@pcr.ac.id', '5024e30a5f3d993c4ccd197b00c964f9', 'perempuan', '08962134578', 'Ada'),
(2, 'bayu', 'bayu@pcr.ac.id', '68276205066ae8264fade33422af399f', 'laki-laki', '08965123478', 'Ada'),
(3, 'mola', 'mola@pcr.ac.id', '9214e8d196d5c370b31544b028e6983f', 'perempuan', '089671354286', 'Ada'),
(4, 'banu', 'banu@pcr.ac.id', 'b38f3b8ab934a1f783be94158b628dec', 'laki-laki', '08976895412', 'Ada'),
(5, 'tami', 'tami@pcr.ac.id', '5ba0be6cc0da555ff45a49d870fd57b3', 'perempuan', '089231876543', 'Tidak Ada'),
(6, 'tuti', 'tuti@pcr.ac.id', 'e5f8d13d731f580dceb74c4572d3f7a9', 'perempuan', '08963214321', 'Ada'),
(7, 'bagus', 'bagus@pcr.ac.id', '2c9a7bf011b0eafee6ee48b2b2b55f9f', 'laki-laki', '08934125678', 'Tidak Ada'),
(8, 'harto', 'harto@pcr.ac.id', '5195106402898cc44b77302267e6c2e5', 'laki-laki', '0897614253', 'Tidak Ada'),
(9, 'lana', 'lana@pcr.ac.id', 'e4551d969a0edee78507dd433b9c916c', 'perempuan', '089617389276', 'Ada'),
(10, 'arsel', 'arsel@pcr.ac.id', '32054be821bf15540dc523c61745eaea', 'laki-laki', '08934567893', 'Tidak Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaju`
--

CREATE TABLE `pengaju` (
  `pengaju_id` int(255) NOT NULL,
  `pengaju_nama` varchar(255) NOT NULL,
  `pengaju_email` varchar(255) NOT NULL,
  `pengaju_jk` varchar(255) DEFAULT NULL,
  `pengaju_pass` varchar(255) DEFAULT NULL,
  `pengaju_noTlp` varchar(20) DEFAULT NULL,
  `pengaju_jenis` varchar(255) DEFAULT NULL,
  `pengaju_foto_profil` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaju`
--

INSERT INTO `pengaju` (`pengaju_id`, `pengaju_nama`, `pengaju_email`, `pengaju_jk`, `pengaju_pass`, `pengaju_noTlp`, `pengaju_jenis`, `pengaju_foto_profil`) VALUES
(1, 'asda', 'rifqy23ti@pcr.ac.id', 'Laki-Laki', 'ac46eb486151ace237901a3ead8fde11', '8988667', 'Dosen', NULL),
(2, 'tes', 'tes@pcr.ac.id', 'Perempuan', '28b662d883b6d76fd96e4ddc5e9ba780', '085764532', 'Mahasiswa', NULL),
(3, 'April', 'april@pcr.ac.id', 'Perempuan', 'f96f2dbc1aae0b2f99a7fe92eeb4ae39', '0897654321', 'Mahasiswa', NULL),
(4, 'lala', 'lala@mahasiswa.pcr.ac.id', 'perempuan', 'c632a6e0a5238669aa0a4cc8ce56944e', '0896432156', 'mahasiswa', NULL),
(5, 'dudung', 'dudung@pcr.ac.id', 'laki-laki', '2ce5a10835c9f1fe4fb1ff13ef2b3331', '08923451768', 'dosen', NULL),
(6, 'yahya', 'yahya@pcr.ac.id', 'laki-laki', 'b2c00340dcbe97a4e555a3554b514618', '08976434161', 'dosen', NULL),
(7, 'kola', 'kola@mahasiswa.pcr.ac.id', 'perempuan', '1d6d6277a96687d1e42d0ce030f4d901', '0896571234', 'mahasiswa', NULL),
(8, 'abdul', 'abdul@pcr.ac.id', 'Laki-laki', '550a141f12de6341fba65b0ad0433500', '089778658850', 'mahasiswa', NULL),
(9, 'ipul', 'ipul@pcr.ac.id', 'Laki-laki', '15de21c670ae7c3f6f3f1f37029303c9', '089766307712', 'Dosen', NULL),
(10, 'Marcopolo', 'Marc@pcr.ac.id', 'Laki-laki', 'f1c1592588411002af340cbaedd6fc33', '089766453320', 'Mahasiswa', NULL),
(11, 'ww', '123', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '213213', 'Mahasiswa', NULL),
(12, 'Rifqy', 'qiqi@pcr', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '08123123', 'Dosen', NULL),
(13, 'waw', 'waw@pcr.ac.id', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '081233212', 'Dosen', NULL),
(14, 'mbeh', 'mbeh@pcr.ac.id', 'Perempuan', '4d9375201582469ec8d0ceefd8206720', '98123456', 'Mahasiswa', NULL),
(15, 'ucok', 'ucok@pcr.ac.id', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '086788766545', 'Mahasiswa', NULL),
(16, 'rifqy', 'aa@pcr', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '123', 'Dosen', NULL),
(17, 'Asep', 'asep@pcr', 'Laki-Laki', '202cb962ac59075b964b07152d234b70', '08213123', 'Mahasiswa', NULL),
(18, 'liaa', 'lia@pcr', 'Perempuan', '202cb962ac59075b964b07152d234b70', '0896543217', 'Mahasiswa', NULL),
(19, 'fikrialhashif', 'fikri23ti@mahasiswa.pcr.ac.id', 'Laki-Laki', '416746987af06f9043f546e4483d27a7', '085788500214', 'Mahasiswa', NULL),
(21, 'ww', 'ww@pcr', 'Perempuan', '202cb962ac59075b964b07152d234b70', '08123321', 'Staf', NULL),
(28, 'RIFQY WAFIANERDZA', 'rifqy23ti@mahasiswa.pcr.ac.id', NULL, NULL, NULL, 'Mahasiswa', 'https://lh3.googleusercontent.com/a/ACg8ocLPNWSXBtRmEc5C_namWOKXNBQx2WjV3Bf2PMRTC_6cuTxZ9chY=s96-c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf`
--

CREATE TABLE `staf` (
  `staf_id` int(255) NOT NULL,
  `staf_nama` varchar(255) NOT NULL,
  `staf_email` varchar(255) NOT NULL,
  `staf_pass` varchar(255) NOT NULL,
  `staf_jk` varchar(255) NOT NULL,
  `staf_noTlp` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staf`
--

INSERT INTO `staf` (`staf_id`, `staf_nama`, `staf_email`, `staf_pass`, `staf_jk`, `staf_noTlp`) VALUES
(1, 'Arimby', 'arimby@pcr.ac.id', 'e39af9e398b8b92c18daf92ba8e0219d', 'perempuan', '0896543212'),
(2, 'rifqy', 'rifqyy@pcr.ac.id', '11e54fe99bba3b25cd6e9fdecd6185a0', 'laki-laki', '08958764321'),
(3, 'fikri', 'fikri@pcr.ac.id', '945af650d38ceca4fabd1e2bd7e6b95c', 'laki-laki', '08956432178'),
(4, 'auliaa', 'auliaa@pcr.ac.id', '5380801648c66572f802b651ac050b13', 'perempuan', '089621764826'),
(5, 'nada', 'nada@pcr.ac.id', 'c31a275423c901d0d1652e5480b9f326', 'perempuan', '089234152678'),
(6, 'zukri', 'zukri@pcr.ac.id', '3923ff327cbe785dfd4af053b8f080d5', 'laki-laki', '08978654342'),
(7, 'wulan', 'wulan@pcr.ac.id', 'f9b72936ce620fe0188178f7917a5482', 'perempuan', '08987654321'),
(8, 'muli', 'muli@pcr.ac.id', '0d3637d35390b030855f2be0f1d81b9c', 'laki-laki', '08923789651'),
(9, 'loli', 'loli@pcr.ac.id', '994375777fd2ba1b34cf3485c075b8f3', 'perempuan', '08974536218'),
(10, 'tomi', 'tomi@pcr.ac.id', '27aaccaacc113b102e5887b14aa8023d', 'laki-laki', '089743982176'),
(11, 'asep', '123@pcr', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', '08214321'),
(12, 'Rahma', 'rahma@pcr.ac.id', '61708596e7bf9a6085e4feaa051335a3', 'Perempuan', '0897654321'),
(13, 'kiki', 'kiki@pcr.ac.id', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', '09888756786'),
(14, 'rifqy', 'aaa@pcr', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', '0812321332'),
(15, 'Arimby Ebhyella Kevin', 'arimby@pcr', '202cb962ac59075b964b07152d234b70', 'Perempuan', '90909'),
(16, 'april', 'april@pcr', '202cb962ac59075b964b07152d234b70', 'Perempuan', '0896543721'),
(17, 'aa', 'ss@pcr', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', '08213132');

-- --------------------------------------------------------

--
-- Struktur untuk view `bukujoin`
--
DROP TABLE IF EXISTS `bukujoin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bukujoin`  AS SELECT `b`.`buku_id` AS `buku_id`, `b`.`buku_judul` AS `buku_judul`, `b`.`buku_tahun` AS `buku_tahun`, `b`.`buku_penulis` AS `buku_penulis`, `b`.`buku_status` AS `buku_status`, `b`.`buku_dokumen` AS `buku_dokumen`, `b`.`buku_tanggal_pengajuan` AS `buku_tanggal_pengajuan`, `b`.`buku_isbn` AS `buku_isbn`, `b`.`pengaju_id` AS `pengaju_id`, `p`.`pengaju_nama` AS `pengaju_nama`, `s`.`staf_id` AS `staf_id`, `s`.`staf_nama` AS `staf_nama`, `b`.`editor_id` AS `editor_id`, `e`.`editor_nama` AS `editor_nama` FROM (((`buku` `b` left join `pengaju` `p` on(`b`.`pengaju_id` = `p`.`pengaju_id`)) left join `staf` `s` on(`b`.`staf_id` = `s`.`staf_id`)) left join `editor` `e` on(`b`.`editor_id` = `e`.`editor_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`),
  ADD KEY `pengaju_id` (`pengaju_id`),
  ADD KEY `admin_id` (`staf_id`),
  ADD KEY `editor_id` (`editor_id`);

--
-- Indeks untuk tabel `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`editor_id`);

--
-- Indeks untuk tabel `pengaju`
--
ALTER TABLE `pengaju`
  ADD PRIMARY KEY (`pengaju_id`);

--
-- Indeks untuk tabel `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`staf_id`),
  ADD UNIQUE KEY `staf_email` (`staf_email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `editor`
--
ALTER TABLE `editor`
  MODIFY `editor_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengaju`
--
ALTER TABLE `pengaju`
  MODIFY `pengaju_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `staf`
--
ALTER TABLE `staf`
  MODIFY `staf_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`staf_id`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`editor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
