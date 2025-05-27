<?php
// Veritabanı bağlantısını dahil et
include("config.php");

// Form verilerini POST ile alalım
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gerekli verileri alıyoruz
    $year = isset($_POST["year"]) ? $_POST["year"] : null;
    $quarter = isset($_POST["quarter"]) ? $_POST["quarter"] : null;
    $kpi_type = isset($_POST["kpi_type"]) ? $_POST["kpi_type"] : null;
    $target_value = isset($_POST["target_value"]) ? $_POST["target_value"] : null;
    $notes = isset($_POST["notes"]) ? $_POST["notes"] : null;
    $score = isset($_POST["score"]) ? (int)$_POST["score"] : 0;
    $max_score = isset($_POST["max_score"]) ? (int)$_POST["max_score"] : 0;
    $actual_value = 0;

    // KPI hesaplamaları
    switch ($kpi_type) {
        case "audit_score":
            $inspection_count = isset($_POST["inspection_count"]) ? (int)$_POST["inspection_count"] : 0;
            $inspection_duration = isset($_POST["inspection_duration"]) ? (int)$_POST["inspection_duration"] : 0;
            $actual_value = ($inspection_duration > 0) ? round(($inspection_count / $inspection_duration) * 100, 2) : 0;
            break;

        case "inspection_score":
            $inspection_count = isset($_POST["inspection_count"]) ? (int)$_POST["inspection_count"] : 0;
            $inspection_findings = isset($_POST["inspection_findings"]) ? (int)$_POST["inspection_findings"] : 0;
            $actual_value = ($inspection_count > 0) ? round(($inspection_findings / $inspection_count) * 100, 2) : 0;
            break;

        case "compliance_score":
            $high_risk_findings = isset($_POST["high_risk_findings"]) ? (int)$_POST["high_risk_findings"] : 0;
            $high_risk_inspections = isset($_POST["high_risk_inspections"]) ? (int)$_POST["high_risk_inspections"] : 0;
            $actual_value = ($high_risk_inspections > 0) ? round(($high_risk_findings / $high_risk_inspections) * 100, 2) : 0;
            break;

        case "other_score":
            $terminal_inspections = isset($_POST["terminal_inspections"]) ? (int)$_POST["terminal_inspections"] : 0;
            $actual_value = ($terminal_inspections > 0) ? $terminal_inspections : 0;
            break;

        default:
            die("❌ Geçersiz KPI türü.");
    }

    // Veritabanına kaydetme
    $sql = "INSERT INTO audit_kpi (year, quarter, kpi_type, target_value, actual_value, unit, notes, score, max_score";

    // KPI türüne göre veri ekleme
    if ($kpi_type == "audit_score") {
        $sql .= ", inspection_count, inspection_duration";
    } elseif ($kpi_type == "inspection_score") {
        $sql .= ", inspection_count, inspection_findings";
    } elseif ($kpi_type == "compliance_score") {
        $sql .= ", high_risk_findings, high_risk_inspections";
    } elseif ($kpi_type == "other_score") {
        $sql .= ", terminal_inspections";
    }

    $sql .= ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?";

    // Parametreler
    $types = "sisssssii";
    $params = [$year, $quarter, $kpi_type, $target_value, $actual_value, "oran", $notes, $score, $max_score];

    if ($kpi_type == "audit_score") {
        $sql .= ", ?, ?";
        $types .= "ii";
        $params[] = $inspection_count;
        $params[] = $inspection_duration;
    } elseif ($kpi_type == "inspection_score") {
        $sql .= ", ?, ?";
        $types .= "ii";
        $params[] = $inspection_count;
        $params[] = $inspection_findings;
    } elseif ($kpi_type == "compliance_score") {
        $sql .= ", ?, ?";
        $types .= "ii";
        $params[] = $high_risk_findings;
        $params[] = $high_risk_inspections;
    } elseif ($kpi_type == "other_score") {
        $sql .= ", ?";
        $types .= "i";
        $params[] = $terminal_inspections;
    }

    $sql .= ")";

    // Veritabanına veri ekleyelim
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("❌ SQL Sorgusu Hatası: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        header("Location: audit_kpi_list.php");
        exit();
    } else {
        echo "❌ Kayıt hatası: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Geçersiz istek yöntemi.";
}
?>
