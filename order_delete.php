<?php
include "config.php";

if (!isset($_GET['id'])) {
    echo "❌ Hatalı istek: ID parametresi yok!";
    exit;
}

$id = $_GET['id'];

// Güvenli silme işlemi
$sql = "DELETE FROM orders WHERE id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "✅ Sipariş başarıyla silindi!";
    echo "<br><a href='orders_list.php'>Listeye Geri Dön</a>";
} else {
    echo "❌ Hata: " . $stmt->error;
}

$stmt->close();
$baglan->close();
?>
