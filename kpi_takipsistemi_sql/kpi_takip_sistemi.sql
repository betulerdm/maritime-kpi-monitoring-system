-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:8889
-- Üretim Zamanı: 27 May 2025, 16:16:43
-- Sunucu sürümü: 5.7.39
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kpi_takip_sistemi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `audit_kpi`
--

CREATE TABLE `audit_kpi` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `quarter` varchar(10) DEFAULT NULL,
  `kpi_type` varchar(50) DEFAULT NULL,
  `target_value` decimal(10,2) NOT NULL,
  `actual_value` decimal(10,2) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `notes` text,
  `score` int(11) NOT NULL,
  `max_score` int(11) NOT NULL,
  `inspection_count` int(11) DEFAULT NULL,
  `inspection_duration` int(11) DEFAULT NULL,
  `inspection_findings` int(11) DEFAULT NULL,
  `high_risk_findings` int(11) DEFAULT NULL,
  `high_risk_inspections` int(11) DEFAULT NULL,
  `terminal_inspections` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `audit_kpi`
--

INSERT INTO `audit_kpi` (`id`, `year`, `quarter`, `kpi_type`, `target_value`, `actual_value`, `unit`, `notes`, `score`, `max_score`, `inspection_count`, `inspection_duration`, `inspection_findings`, `high_risk_findings`, `high_risk_inspections`, `terminal_inspections`, `created_at`) VALUES
(1, 2033, '0', 'kpi1', '4.00', '80.00', 'oran', 'gggg', 0, 0, 4, 5, NULL, NULL, NULL, NULL, '2025-05-13 10:37:51'),
(2, 2024, '0', 'kpi2', '200.00', '50.00', 'oran', '', 0, 0, 10, NULL, 5, NULL, NULL, NULL, '2025-05-13 16:03:23'),
(3, 2024, '0', 'kpi1', '44.00', '0.00', 'oran', 'bbb\r\n', 22, 33, 0, 0, NULL, NULL, NULL, NULL, '2025-05-13 16:21:45'),
(4, 2024, '0', 'audit_score', '23.00', '0.00', 'oran', 'ff', 12, 11, 0, 0, NULL, NULL, NULL, NULL, '2025-05-18 11:03:23'),
(5, 2024, '0', 'inspection_score', '12.00', '0.00', 'oran', 'deneme', 12, 10, 0, NULL, 0, NULL, NULL, NULL, '2025-05-18 11:03:41'),
(6, 2024, '0', 'compliance_score', '150.00', '0.00', 'oran', 'ee', 100, 140, NULL, NULL, NULL, 0, 0, NULL, '2025-05-25 10:59:33');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belgeler`
--

CREATE TABLE `belgeler` (
  `id` int(11) NOT NULL,
  `belge_adi` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `yuklenme_tarihi` date NOT NULL,
  `gecerlilik_tarihi` date DEFAULT NULL,
  `dosya_yolu` varchar(255) NOT NULL,
  `yuklenme_zamani` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `belgeler`
--

INSERT INTO `belgeler` (`id`, `belge_adi`, `kategori`, `yuklenme_tarihi`, `gecerlilik_tarihi`, `dosya_yolu`, `yuklenme_zamani`) VALUES
(1, 'deneme1', 'Gemi Sertifikası', '2025-05-20', '2025-05-23', 'uploads/1747682792_DilaraBetülErdem-cv.pdf', '2025-05-19 19:26:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `siparis_id` int(11) DEFAULT NULL,
  `sikayet_konu` text,
  `sikayet_tarihi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `tedarikci_id` int(11) DEFAULT NULL,
  `puan` int(11) DEFAULT NULL,
  `degerlendirme_tarihi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kpi_health`
--

CREATE TABLE `kpi_health` (
  `id` int(11) NOT NULL,
  `kpi_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `quarter` varchar(10) NOT NULL,
  `target_value` varchar(50) DEFAULT NULL,
  `actual_value` varchar(50) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `notes` text,
  `injuries` int(11) DEFAULT NULL,
  `treatments` int(11) DEFAULT NULL,
  `nearmiss` int(11) DEFAULT NULL,
  `employees` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kpi_health`
--

INSERT INTO `kpi_health` (`id`, `kpi_name`, `year`, `quarter`, `target_value`, `actual_value`, `unit`, `notes`, `injuries`, `treatments`, `nearmiss`, `employees`, `days`, `hours`, `created_at`) VALUES
(2, 'Lost Time Injury Frequency', 2024, 'Q1', '3.5', '13.33', 'oran', 'Düşük riskli alan', 2, NULL, NULL, NULL, NULL, 150000, '2025-05-12 13:15:45'),
(4, 'Medical Treatment Case Rate', 2024, 'Q2', '4.5', '25', 'oran', 'ilk yardım içerir', NULL, 5, NULL, NULL, NULL, 200000, '2025-05-12 13:17:02'),
(5, 'Near Miss Reporting Rate', 2024, 'Q3', '0.05', '0.08', 'oran', 'Raporlamalar arttı\r\n', NULL, NULL, 10, 120, NULL, NULL, '2025-05-12 13:17:34'),
(6, 'Days Away From Work Rate', 2024, 'Q4', '5.0', '60', 'gün', '2 personel uzun süreli raporlu', NULL, NULL, NULL, NULL, 12, 200000, '2025-05-12 13:19:20'),
(7, 'Lost Time Injury Frequency', 222, 'Q1', '666', '111000000', 'oran', 'gkgkg', 555, NULL, NULL, NULL, NULL, 5, '2025-05-13 10:32:46');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kpi_logistics`
--

CREATE TABLE `kpi_logistics` (
  `id` int(11) NOT NULL,
  `kpi_name` varchar(255) NOT NULL,
  `vessel` varchar(100) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `quarter` varchar(10) NOT NULL,
  `target_value` varchar(50) DEFAULT NULL,
  `actual_value` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `notes` text,
  `ontime_deliveries` int(11) DEFAULT NULL,
  `total_deliveries` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `compliant_orders` int(11) DEFAULT NULL,
  `total_orders` int(11) DEFAULT NULL,
  `emergency_orders` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kpi_logistics`
--

INSERT INTO `kpi_logistics` (`id`, `kpi_name`, `vessel`, `year`, `quarter`, `target_value`, `actual_value`, `unit`, `notes`, `ontime_deliveries`, `total_deliveries`, `order_date`, `delivery_date`, `compliant_orders`, `total_orders`, `emergency_orders`, `created_at`) VALUES
(1, 'On-Time Delivery Rate', '', 2024, 'Q1', '%95', '90%', '%', 'Genel performans iyi', 18, 20, NULL, NULL, NULL, NULL, NULL, '2025-05-12 12:50:04'),
(2, 'Procurement Cycle Time', '', 2024, 'Q2', '5 gün', '6 gün', 'gün', '2 gün gecikme', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-12 12:51:36'),
(3, 'Supplier Compliance Rate', '', 2024, 'Q3', '%95', '93.33%', '%', '	İki teslimatta sapma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-12 12:52:13'),
(4, 'Emergency Purchase Ratio', '', 2024, 'Q4', '%10', '10%', '%', '	3 alım ani oldu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-12 12:52:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kpi_logs`
--

CREATE TABLE `kpi_logs` (
  `id` int(11) NOT NULL,
  `kpi_adi` varchar(255) DEFAULT NULL,
  `hesaplanan_sonuc` decimal(10,2) DEFAULT NULL,
  `tarih` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `olay_ramak_kala_kpi`
--

CREATE TABLE `olay_ramak_kala_kpi` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `quarter` varchar(2) NOT NULL,
  `near_miss_count` int(11) DEFAULT '0',
  `reported_incidents` int(11) DEFAULT '0',
  `investigated_incidents` int(11) DEFAULT '0',
  `investigation_rate` float DEFAULT '0',
  `closing_time` float DEFAULT '0',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `olay_ramak_kala_kpi`
--

INSERT INTO `olay_ramak_kala_kpi` (`id`, `year`, `quarter`, `near_miss_count`, `reported_incidents`, `investigated_incidents`, `investigation_rate`, `closing_time`, `notes`, `created_at`) VALUES
(1, 2024, 'Q1', 2, 0, 0, 0, 0, 'jjj', '2025-05-16 19:16:39'),
(2, 2024, 'Q1', 12, 0, 0, 0, 0, 'ilk çeyrek için test verisi', '2025-05-16 19:34:55'),
(3, 2024, 'Q1', 0, 20, 0, 0, 0, 'Bildirilen olay sayısı hedefe göre biraz fazla', '2025-05-16 19:35:16'),
(4, 2024, 'Q1', 0, 20, 16, 80, 0, 'iyi araştırma perfonmansı', '2025-05-16 19:35:47'),
(5, 2024, 'Q1', 0, 0, 0, 0, 4.5, 'Kapatma süresi hedefe uygun', '2025-05-16 19:36:06'),
(6, 2024, 'Q1', 0, 0, 0, 0, 4.5, 'Kapatma süresi hedefe uygun', '2025-05-16 19:46:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tedarikci_id` int(11) DEFAULT NULL,
  `siparis_no` varchar(100) DEFAULT NULL,
  `talep_tarihi` date DEFAULT NULL,
  `teslim_edildi` enum('Evet','Hayir') DEFAULT NULL,
  `teslim_tarihi` date DEFAULT NULL,
  `acil` enum('Evet','Hayir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `tedarikci_id`, `siparis_no`, `talep_tarihi`, `teslim_edildi`, `teslim_tarihi`, `acil`) VALUES
(1, 10002, '102', '2024-11-14', 'Evet', '2025-04-16', 'Evet');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `performance_evaluations`
--

CREATE TABLE `performance_evaluations` (
  `id` int(11) NOT NULL,
  `personel_adi` varchar(100) DEFAULT NULL,
  `departman` varchar(100) DEFAULT NULL,
  `tedarikci` varchar(100) DEFAULT NULL,
  `siparis_no` varchar(100) DEFAULT NULL,
  `teslim_suresi` int(11) DEFAULT NULL,
  `zamaninda_teslim` varchar(10) NOT NULL,
  `kalite_durumu` enum('Uygun','Uygun Değil') DEFAULT NULL,
  `sikayet_sayisi` int(11) DEFAULT NULL,
  `performans_durumu` varchar(50) DEFAULT NULL,
  `degerlendirme_tarihi` date DEFAULT NULL,
  `yorum` text,
  `kayit_tarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `performance_evaluations`
--

INSERT INTO `performance_evaluations` (`id`, `personel_adi`, `departman`, `tedarikci`, `siparis_no`, `teslim_suresi`, `zamaninda_teslim`, `kalite_durumu`, `sikayet_sayisi`, `performans_durumu`, `degerlendirme_tarihi`, `yorum`, `kayit_tarihi`) VALUES
(1, 'Ahmet', 'deniz', 'şirket', '305', 12, '0', 'Uygun Değil', 9, 'İyi', '2025-04-18', 'deneme', '2025-04-17 18:38:04'),
(5, 'Ahmet Yılmaz', 'Depo', 'ORD342', '100', 2, '0', 'Uygun', 0, 'İyi', '2025-03-12', '', '2025-04-18 11:47:18'),
(7, 'Ali Yılmaz', 'Depo', 'dermarin', 'ord320', 3, '0', 'Uygun', 0, 'İyi', '2025-02-11', '', '2025-04-18 11:51:52'),
(8, 'Pelin Demir', 'Depo', 'dermarin', 'ord234', 3, '0', 'Uygun', 0, 'Orta', '2024-11-14', '', '2025-04-18 11:53:39'),
(11, 'Ahmet Yılmaz', 'Depo', 'dermanın', 'ORD300', 3, '0', 'Uygun', 0, 'İyi', '2025-02-12', '', '2025-04-18 12:11:12'),
(12, 'Dilara güneş ', 'deneme', 'deneme', '3000', 4, '0', 'Uygun', 0, 'Orta', '2025-03-06', '', '2025-04-18 13:39:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `firma_adi` varchar(255) NOT NULL,
  `adres` text NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `iso9001` enum('Var','Yok') NOT NULL,
  `iso14001` enum('Var','Yok') NOT NULL,
  `iso45001` enum('Var','Yok') NOT NULL,
  `kayit_tarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `suppliers`
--

INSERT INTO `suppliers` (`id`, `firma_adi`, `adres`, `telefon`, `iso9001`, `iso14001`, `iso45001`, `kayit_tarihi`) VALUES
(1, 'dermarine', 'ateşehir', '05422263524', 'Var', 'Var', 'Var', '2025-04-16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `technical_kpi`
--

CREATE TABLE `technical_kpi` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `quarter` varchar(2) NOT NULL,
  `kpi_type` varchar(50) NOT NULL,
  `actual_value` decimal(10,2) DEFAULT NULL,
  `notes` text,
  `overdue_items` int(11) NOT NULL DEFAULT '0',
  `total_items` int(11) NOT NULL DEFAULT '0',
  `failure_count` int(11) NOT NULL DEFAULT '0',
  `working_hours` int(11) NOT NULL DEFAULT '0',
  `downtime` int(11) NOT NULL DEFAULT '0',
  `total_hours` int(11) NOT NULL DEFAULT '0',
  `critical_failures` int(11) NOT NULL DEFAULT '0',
  `total_failures` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `technical_kpi`
--

INSERT INTO `technical_kpi` (`id`, `year`, `quarter`, `kpi_type`, `actual_value`, `notes`, `overdue_items`, `total_items`, `failure_count`, `working_hours`, `downtime`, `total_hours`, `critical_failures`, `total_failures`, `created_at`) VALUES
(1, 2024, 'Q1', 'overdue_maintenance', '105.56', 'deneme', 19, 18, 0, 0, 0, 0, 0, 0, '2025-05-18 17:03:38'),
(2, 2024, 'Q1', 'overdue_maintenance', '105.56', 'deneme', 19, 18, 0, 0, 0, 0, 0, 0, '2025-05-18 17:03:56'),
(3, 2024, 'Q1', 'overdue_maintenance', '105.56', 'deneme', 19, 18, 0, 0, 0, 0, 0, 0, '2025-05-18 17:06:50'),
(4, 2024, 'Q1', 'overdue_maintenance', '100.00', 'denneme\r\n', 20, 20, 0, 0, 0, 0, 0, 0, '2025-05-18 18:11:29'),
(5, 2024, 'Q1', 'overdue_maintenance', '92.31', 'den', 12, 13, 0, 0, 0, 0, 0, 0, '2025-05-18 18:12:28'),
(6, 2024, 'Q1', 'failure_frequency', '0.20', 'Önemli ekipmanlarda kritik arıza tespit edildi.', 0, 0, 4, 20, 0, 0, 0, 0, '2025-05-18 18:13:32'),
(7, 2024, 'Q2', 'overdue_maintenance', '40.00', 'Planlı bakım gecikmeleri yaşandı.\r\n\r\n', 12, 30, 0, 0, 0, 0, 0, 0, '2025-05-18 18:14:07'),
(8, 2024, 'Q1', 'failure_frequency', '0.03', '	Stabil üretim', 0, 0, 18, 600, 0, 0, 0, 0, '2025-05-18 18:15:08'),
(9, 2024, 'Q1', 'overdue_maintenance', '66.67', 'ffh', 2, 3, 0, 0, 0, 0, 0, 0, '2025-05-18 18:45:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `kullanici_adi`, `email`, `telefon`, `sifre`) VALUES
(1, 'dilara', 'dilaraerdem@hotmail.com', '05515562135', '$2y$10$mg8tDhzGYSfgHm3SMnjYfORFIc4Ev2B/habPnn0Cg.F7g9P3NUg3G'),
(2, 'betul', 'betulerdem7@gmailcom', '05422287039', '$2y$10$qmCPCbs.WgMTwdNiirtR7uQe8ZGpxT0/hJe8bynddmm/bOj7BZMGq');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `audit_kpi`
--
ALTER TABLE `audit_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `belgeler`
--
ALTER TABLE `belgeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siparis_id` (`siparis_id`);

--
-- Tablo için indeksler `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tedarikci_id` (`tedarikci_id`);

--
-- Tablo için indeksler `kpi_health`
--
ALTER TABLE `kpi_health`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kpi_logistics`
--
ALTER TABLE `kpi_logistics`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kpi_logs`
--
ALTER TABLE `kpi_logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `olay_ramak_kala_kpi`
--
ALTER TABLE `olay_ramak_kala_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tedarikci_id` (`tedarikci_id`);

--
-- Tablo için indeksler `performance_evaluations`
--
ALTER TABLE `performance_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `technical_kpi`
--
ALTER TABLE `technical_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `audit_kpi`
--
ALTER TABLE `audit_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `belgeler`
--
ALTER TABLE `belgeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kpi_health`
--
ALTER TABLE `kpi_health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `kpi_logistics`
--
ALTER TABLE `kpi_logistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `kpi_logs`
--
ALTER TABLE `kpi_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `olay_ramak_kala_kpi`
--
ALTER TABLE `olay_ramak_kala_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `performance_evaluations`
--
ALTER TABLE `performance_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `technical_kpi`
--
ALTER TABLE `technical_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`siparis_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
