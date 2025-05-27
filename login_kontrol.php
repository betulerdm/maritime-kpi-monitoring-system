<?php
include "config.php";


$kullanici_adi = $_POST['kullanici_adi'];
$sifre = $_POST['sifre'];

$sql = "SELECT * FROM users WHERE email='$kullanici_adi'";
echo "SQL Sorgusu: $sql";  // SQL komutunu ekrana yazsın
$result = $baglan->query($sql);

if($result->num_rows == 1){
    $row = $result->fetch_assoc();

    if(password_verify($sifre, $row['sifre'])){
        session_start();
        $_SESSION['kullanici_adi'] = $kullanici_adi;
        
        // Kullanıcı doğruysa dashboard.php'ye yönlendir
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Şifre Hatalı!";
    }
} else {
    echo "Böyle bir kullanıcı yok!";
}
?>
