<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kpi_type = $_POST["kpi_type"];
    $year = $_POST["year"];
    $quarter = $_POST["quarter"];
    $target_value = $_POST["target_value"];
    $notes = $_POST["notes"];
    $unit = ($kpi_type == "daysaway") ? "gün" : "oran";
    $kpi_name = "";
    $actual_value = "";

    // Girişe göre hesaplamalar
    switch ($kpi_type) {
        case "ltif":
            $kpi_name = "Lost Time Injury Frequency";
            $injuries = (int)$_POST["injuries"];
            $hours = (int)$_POST["hours"];
            $actual_value = ($hours > 0) ? round(($injuries / $hours) * 1000000, 2) : 0;
            break;

        case "mtcr":
            $kpi_name = "Medical Treatment Case Rate";
            $treatments = (int)$_POST["treatments"];
            $hours = (int)$_POST["hours"];
            $actual_value = ($hours > 0) ? round(($treatments / $hours) * 1000000, 2) : 0;
            break;

        case "nearmiss":
            $kpi_name = "Near Miss Reporting Rate";
            $nearmiss = (int)$_POST["nearmiss"];
            $employees = (int)$_POST["employees"];
            $actual_value = ($employees > 0) ? round(($nearmiss / $employees), 2) : 0;
            break;

        case "daysaway":
            $kpi_name = "Days Away From Work Rate";
            $days = (int)$_POST["days"];
            $hours = (int)$_POST["hours"];
            $actual_value = ($hours > 0) ? round(($days / $hours) * 1000000, 2) : 0;
            break;

        default:
            die("❌ Geçersiz KPI türü.");
    }

    // SQL Sorgusu
    $sql = "INSERT INTO kpi_health (kpi_name, year, quarter, target_value, actual_value, unit, notes";
    $fields = ") VALUES (?, ?, ?, ?, ?, ?, ?";
    $types = "sisssss";
    $params = [$kpi_name, $year, $quarter, $target_value, $actual_value, $unit, $notes];

    // KPI'ya özel alanlar
    if ($kpi_type == "ltif") {
        $sql .= ", injuries, hours";
        $fields .= ", ?, ?";
        $types .= "ii";
        $params[] = $injuries;
        $params[] = $hours;
    } elseif ($kpi_type == "mtcr") {
        $sql .= ", treatments, hours";
        $fields .= ", ?, ?";
        $types .= "ii";
        $params[] = $treatments;
        $params[] = $hours;
    } elseif ($kpi_type == "nearmiss") {
        $sql .= ", nearmiss, employees";
        $fields .= ", ?, ?";
        $types .= "ii";
        $params[] = $nearmiss;
        $params[] = $employees;
    } elseif ($kpi_type == "daysaway") {
        $sql .= ", days, hours";
        $fields .= ", ?, ?";
        $types .= "ii";
        $params[] = $days;
        $params[] = $hours;
    }

    $sql .= $fields . ")";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        header("Location: health_kpi_list.php");
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
