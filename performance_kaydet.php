<?php
include "config.php";
echo "DOSYA ÇALIŞIYOR";

// Formdan gelen verileri al
$personel_adi = $_POST['personel_adi'];
$departman = $_POST['departman'];
$tedarikci = $_POST['tedarikci'];
$siparis_no = $_POST['siparis_no'];
$teslim_suresi = (int)$_POST['teslim_suresi'];

// zamaninda_teslim: 'evet' => 1, 'hayır' => 0
$zamaninda_teslim = (strtolower($_POST['zamaninda_teslim']) === 'evet') ? 1 : 0;

// kalite_durumu: sadece 'Uygun' veya 'Uygun Değil' olmalı
$kalite_raw = strtolower(trim($_POST['kalite_durumu']));
$kalite_durumu = ($kalite_raw === 'uygun') ? 'Uygun' : 'Uygun Değil';

$sikayet_sayisi = (int)$_POST['sikayet_sayisi'];
$performans_durumu = $_POST['performans_durumu'];

// Tarih standardizasyonu
$degerlendirme_tarihi = date('Y-m-d', strtotime($_POST['degerlendirme_tarihi']));
$yorum = $_POST['yorum'];

// SQL sorgusu
$sql = "INSERT INTO performance_evaluations 
(personel_adi, departman, tedarikci, siparis_no, teslim_suresi, zamaninda_teslim, kalite_durumu, sikayet_sayisi, performans_durumu, degerlendirme_tarihi, yorum)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $baglan->prepare($sql);
$stmt->bind_param(
    "ssssiisssss",
    $personel_adi,
    $departman,
    $tedarikci,
    $siparis_no,
    $teslim_suresi,
    $zamaninda_teslim,
    $kalite_durumu,
    $sikayet_sayisi,
    $performans_durumu,
    $degerlendirme_tarihi,
    $yorum
);

// Kayıt işlemi ve yönlendirme
if ($stmt->execute()) {
    header("Location: performance.php?kayit=ok");
    exit;
} else {
    echo "❌ Hata: " . $stmt->error;
}

$stmt->close();
$baglan->close();
?>
