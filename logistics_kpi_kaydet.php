<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kpi_type = $_POST["kpi_type"];
    $year = $_POST["year"];
    $quarter = $_POST["quarter"];
    $target_value = $_POST["target_value"];
    $notes = $_POST["notes"];
    $unit = "%";
    $kpi_name = "";
    $actual_value = "";

    // Ortak kolonlar
    $vessel = "";  // Gemi opsiyonel olduğundan boş

    // KPI türüne göre hesaplamalar
    switch ($kpi_type) {
        case "ontime_delivery":
            $kpi_name = "On-Time Delivery Rate";
            $ontime = (int)$_POST["ontime"];
            $total = (int)$_POST["total"];
            $actual_value = ($total > 0) ? round(($ontime / $total) * 100, 2) . "%" : "0%";
            $ontime_deliveries = $ontime;
            $total_deliveries = $total;
            break;

        case "procurement_time":
            $kpi_name = "Procurement Cycle Time";
            $unit = "gün";
            $order_date = new DateTime($_POST["order_date"]);
            $delivery_date = new DateTime($_POST["delivery_date"]);
            $interval = $order_date->diff($delivery_date);
            $actual_value = $interval->days . " gün";
            break;

        case "supplier_compliance":
            $kpi_name = "Supplier Compliance Rate";
            $compliant = (int)$_POST["compliant"];
            $total = (int)$_POST["total"];
            $actual_value = ($total > 0) ? round(($compliant / $total) * 100, 2) . "%" : "0%";
            break;

        case "emergency_ratio":
            $kpi_name = "Emergency Purchase Ratio";
            $emergency = (int)$_POST["emergency"];
            $total = (int)$_POST["total"];
            $actual_value = ($total > 0) ? round(($emergency / $total) * 100, 2) . "%" : "0%";
            break;

        default:
            die("❌ Bilinmeyen KPI türü.");
    }

    // Kayıt sorgusu
    $sql = "INSERT INTO kpi_logistics (kpi_name, vessel, year, quarter, target_value, actual_value, unit, notes";

    $fields = ") VALUES (?, ?, ?, ?, ?, ?, ?, ?";
    $types = "ssisssss";
    $params = [$kpi_name, $vessel, $year, $quarter, $target_value, $actual_value, $unit, $notes];

    // Ek sütunlar sadece ontime_delivery için
    if ($kpi_type == "ontime_delivery") {
        $sql .= ", ontime_deliveries, total_deliveries";
        $fields .= ", ?, ?";
        $types .= "ii";
        $params[] = $ontime_deliveries;
        $params[] = $total_deliveries;
    }

    $sql .= $fields . ")";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        header("Location: logistics_kpi_list.php");
        exit();
    } else {
        echo "❌ Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
