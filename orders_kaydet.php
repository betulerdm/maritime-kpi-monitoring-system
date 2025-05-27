<?php
include "config.php"; // Veritabanı bağlantısı

// Formdan gelen verileri al
$tedarikci_id   = $_POST['tedarikci_id'];
$siparis_no     = $_POST['siparis_no'];
$talep_tarihi   = $_POST['talep_tarihi'];
$teslim_edildi  = $_POST['teslim_edildi'];
$teslim_tarihi  = $_POST['teslim_tarihi'];
$acil           = $_POST['acil'];

// SQL şablonunu hazırla
$sql = "INSERT INTO orders 
        (tedarikci_id, siparis_no, talep_tarihi, teslim_edildi, teslim_tarihi, acil) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Hazırlanan ifadeyi oluştur
$stmt = $baglan->prepare($sql);

// Türleri belirt: i = integer, s = string (toplam 6 parametre)
$stmt->bind_param("isssss", $tedarikci_id, $siparis_no, $talep_tarihi, $teslim_edildi, $teslim_tarihi, $acil);

// Çalıştır
if ($stmt->execute()) {
    echo "✅ Sipariş başarıyla kaydedildi!";
} else {
    echo "❌ Hata: " . $stmt->error;
}

// Bağlantıyı kapat
$stmt->close();
$baglan->close();
?>
