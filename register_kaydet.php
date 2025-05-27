<?php
include "config.php";

$kullanici_adi = $_POST['kullanici_adi'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT); // Şifreyi hashliyoruz

$sql = "INSERT INTO users (kullanici_adi, email, telefon, sifre)
VALUES ('$kullanici_adi', '$email', '$telefon', '$sifre')";

if($baglan->query($sql) === TRUE){
    echo "Kayıt başarılı! <a href='login.php'>Giriş Yap</a>";
} else {
    echo "Hata: " . $baglan->error;
}
?>
