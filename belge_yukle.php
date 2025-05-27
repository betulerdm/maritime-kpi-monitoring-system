<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $belge_adi = $_POST['belge_adi'];
    $kategori = $_POST['kategori'];
    $yuklenme_tarihi = $_POST['yuklenme_tarihi'];
    $gecerlilik_tarihi = !empty($_POST['gecerlilik_tarihi']) ? $_POST['gecerlilik_tarihi'] : null;

    if (!isset($_FILES['belge_dosya']) || $_FILES['belge_dosya']['error'] !== UPLOAD_ERR_OK) {
        die("❌ Dosya yüklenemedi.");
    }

    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $filename = basename($_FILES['belge_dosya']['name']);
    $target_path = $upload_dir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES['belge_dosya']['tmp_name'], $target_path)) {
        $stmt = $conn->prepare("INSERT INTO belgeler (belge_adi, kategori, yuklenme_tarihi, gecerlilik_tarihi, dosya_yolu) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $belge_adi, $kategori, $yuklenme_tarihi, $gecerlilik_tarihi, $target_path);

        if ($stmt->execute()) {
            header("Location: belge_yonetimi.php");
            exit();
        } else {
            echo "❌ Veritabanına kaydedilirken hata oluştu: " . $stmt->error;
        }
    } else {
        echo "❌ Dosya klasöre taşınamadı.";
    }
} else {
    echo "❌ Hatalı istek.";
}
?>
