<?php
include "config.php";

// Formdan gelen veriler
$firma_adi   = $_POST['firma_adi'];
$adres       = $_POST['adres'];
$telefon     = $_POST['telefon'];
$iso9001     = $_POST['iso9001'];
$iso14001    = $_POST['iso14001'];
$iso45001    = $_POST['iso45001'];

// SQL sorgusu
$sql = "INSERT INTO suppliers (
            firma_adi, 
            adres, 
            telefon, 
            iso9001, 
            iso14001, 
            iso45001, 
            kayit_tarihi
        )
        VALUES (
            '$firma_adi', 
            '$adres', 
            '$telefon', 
            '$iso9001', 
            '$iso14001', 
            '$iso45001', 
            NOW()
        )";

// Sorgu sonucu
if ($baglan->query($sql) === TRUE) {
    echo "✅ Tedarikçi başarıyla kaydedildi!";
} else {
    echo "❌ Hata: " . $baglan->error;
}
?>
