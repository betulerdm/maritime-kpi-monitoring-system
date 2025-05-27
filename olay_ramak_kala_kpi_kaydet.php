<?php
include("config.php"); // veritabanı bağlantı dosyan

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Gelen verileri al
    $year = intval($_POST["year"]);
    $quarter = $_POST["quarter"];
    $notes = isset($_POST["notes"]) ? $_POST["notes"] : "";

    // Hangi KPI tipinde kayıt yapılacak kontrolü
    $kpi_type = isset($_POST["kpi_type"]) ? $_POST["kpi_type"] : "";

    // Varsayılan değerler
    $near_miss_count = 0;
    $reported_incidents = 0;
    $investigated_incidents = 0;
    $investigation_rate = 0;
    $closing_time = 0;

    // KPI türüne göre verileri al ve hesaplamaları yap
    if ($kpi_type === "near_miss_count") {
        $near_miss_count = intval($_POST["near_miss_count"]);
    } elseif ($kpi_type === "reported_incidents") {
        $reported_incidents = intval($_POST["reported_incidents"]);
    } elseif ($kpi_type === "investigation_rate") {
        $reported_incidents = intval($_POST["reported_incidents"]);
        $investigated_incidents = intval($_POST["investigated_incidents"]);
        if ($reported_incidents > 0) {
            $investigation_rate = ($investigated_incidents / $reported_incidents) * 100;
        } else {
            $investigation_rate = 0;
        }
    } elseif ($kpi_type === "closing_time") {
        $closing_time = floatval($_POST["closing_time"]);
    } else {
        // Hatalı kpi_type gelirse hata dönebiliriz
        http_response_code(400);
        echo "Geçersiz KPI tipi!";
        exit;
    }

    // Veritabanına ekleme sorgusu
    $stmt = $conn->prepare("INSERT INTO olay_ramak_kala_kpi (year, quarter, near_miss_count, reported_incidents, investigated_incidents, investigation_rate, closing_time, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiiids", $year, $quarter, $near_miss_count, $reported_incidents, $investigated_incidents, $investigation_rate, $closing_time, $notes);

    if ($stmt->execute()) {
    // Kayıt başarılı ise listeleme sayfasına yönlendir
    header("Location: olay_ramak_kala_kpi_list.php");
    exit;  // script'in devamını durdurur
} else {
    // Hata varsa ekrana göster
    echo "Hata: " . $stmt->error;
}

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Sadece POST isteği kabul edilir.";
}
?>
