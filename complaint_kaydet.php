<?php
include "config.php";

// Form verilerini al
$siparis_id = $_POST['siparis_id'];
$baslik     = $_POST['baslik'];
$aciklama   = $_POST['aciklama'];
$kategori   = $_POST['kategori'];
$tarih      = $_POST['tarih'];

// SQL - Hazırlanmış sorgu
$sql = "INSERT INTO complaints (siparis_id, baslik, aciklama, kategori, tarih) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $baglan->prepare($sql);
$stmt->bind_param("issss", $siparis_id, $baslik, $aciklama, $kategori, $tarih);

if ($stmt->execute()) {
    echo "✅ Şikayet başarıyla kaydedildi!";
    echo "<br><a href='complaint_form.php'>Yeni Şikayet</a> | <a href='dashboard.php'>Dashboard</a>";
} else {
    echo "❌ Hata: " . $stmt->error;
}

$stmt->close();
$baglan->close();
?>
