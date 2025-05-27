<?php
$baglan = new mysqli("localhost", "diloş", "123", "kpi_takip_sistemi");
$baglan->set_charset("utf8");

// Alternatif isimlendirme: tüm projede uyumlu çalışsın
$conn = $baglan;

if ($baglan->connect_error) {
   die("Veritabanı bağlantı hatası: " . $baglan->connect_error);
}
?>
