<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ortak alanlar
    $year = intval($_POST["year"]);
    $quarter = $_POST["quarter"];
    $kpi_type = $_POST["kpi_type"];
    $notes = isset($_POST["notes"]) ? $_POST["notes"] : "";

    // KPI’ya özel veriler (her biri varsayılan 0 ile başlıyor)
    $overdue_items = isset($_POST["overdue_items"]) ? intval($_POST["overdue_items"]) : 0;
    $total_items = isset($_POST["total_items"]) ? intval($_POST["total_items"]) : 0;

    $failure_count = isset($_POST["failure_count"]) ? intval($_POST["failure_count"]) : 0;
    $working_hours = isset($_POST["working_hours"]) ? floatval($_POST["working_hours"]) : 0;

    $downtime = isset($_POST["downtime"]) ? floatval($_POST["downtime"]) : 0;
    $total_hours = isset($_POST["total_hours"]) ? floatval($_POST["total_hours"]) : 0;

    $critical_failures = isset($_POST["critical_failures"]) ? intval($_POST["critical_failures"]) : 0;
    $total_failures = isset($_POST["total_failures"]) ? intval($_POST["total_failures"]) : 0;

    // KPI türüne göre actual_value hesaplanır
    $actual_value = 0;

    switch ($kpi_type) {
        case 'overdue_maintenance':
            $actual_value = ($total_items > 0) ? ($overdue_items / $total_items) * 100 : 0;
            break;

        case 'failure_frequency':
            $actual_value = ($working_hours > 0) ? ($failure_count / $working_hours) : 0;
            break;

        case 'downtime_duration':
            $actual_value = ($total_hours > 0) ? ($downtime / $total_hours) * 100 : 0;
            break;

        case 'critical_failure_ratio':
            $actual_value = ($total_failures > 0) ? ($critical_failures / $total_failures) * 100 : 0;
            break;

        default:
            echo "❌ Geçersiz KPI türü.";
            exit;
    }

    // Veritabanı sorgusu (prepared)
    $sql = "INSERT INTO technical_kpi (
                year, quarter, kpi_type, actual_value, notes, 
                overdue_items, total_items, 
                failure_count, working_hours, 
                downtime, total_hours, 
                critical_failures, total_failures
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("❌ SQL Hatası: " . $conn->error);
    }

    $stmt->bind_param(
        "issdsiiiiiddi",
        $year,
        $quarter,
        $kpi_type,
        $actual_value,
        $notes,
        $overdue_items,
        $total_items,
        $failure_count,
        $working_hours,
        $downtime,
        $total_hours,
        $critical_failures,
        $total_failures
    );

    if ($stmt->execute()) {
        header("Location: technical_kpi_list.php");
        exit;
    } else {
        echo "❌ Kayıt hatası: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Geçersiz istek yöntemi.";
}
?>
