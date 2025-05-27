<?php
include("config.php");

$list_sql = "SELECT * FROM kpi_logistics ORDER BY year DESC, quarter DESC";
$list_result = $conn->query($list_sql);

$chart_sql = "SELECT kpi_name, target_value, actual_value FROM kpi_logistics ORDER BY created_at DESC LIMIT 10";
$chart_result = $conn->query($chart_sql);

$labels = [];
$targets = [];
$actuals = [];

while ($row = $chart_result->fetch_assoc()) {
    $labels[] = $row['kpi_name'];
    $targets[] = floatval(str_replace('%', '', $row['target_value']));
    $actuals[] = floatval(str_replace('%', '', $row['actual_value']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logistics KPI Records</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial; background: #f5fff9; padding: 20px; }
    h2 { text-align: center; color: #407a58; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
      font-size: 14px;
    }
    th { background-color: #5e9c76; color: white; }
    .button-area { text-align: center; margin: 20px 0; }
    .button-area a {
      background-color: #5e9c76;
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      margin: 0 10px;
    }
    .chart-container {
      max-width: 900px;
      margin: 20px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<h2>📊 Logistics KPI Chart (Last 10 Records)</h2>
<div class="chart-container">
  <canvas id="logisticsChart"></canvas>
</div>

<div class="button-area">
  <a href="dashboard.php">🏠 Home</a>
  <a href="logistics_kpi_tabs.php">➕ New Entry</a>
</div>

<h2>📋 Logistics KPI Records</h2>
<table>
  <tr>
    <th>ID</th><th>KPI Name</th><th>Year</th><th>Quarter</th><th>Target</th><th>Actual</th><th>Unit</th>
    <th>On-Time Deliveries</th><th>Total Deliveries</th>
    <th>Order Date</th><th>Delivery Date</th>
    <th>Compliant Orders</th><th>Total Orders</th>
    <th>Emergency Purchases</th><th>Notes</th><th>Entry Date</th>
  </tr>
<?php while ($row = $list_result->fetch_assoc()): ?>
  <tr>
    <td><?= $row["id"] ?></td>
    <td><?= $row["kpi_name"] ?></td>
    <td><?= $row["year"] ?></td>
    <td><?= $row["quarter"] ?></td>
    <td><?= $row["target_value"] ?></td>
    <td><?= $row["actual_value"] ?></td>
    <td><?= $row["unit"] ?></td>
    <td><?= $row["ontime_deliveries"] ?? "-" ?></td>
    <td><?= $row["total_deliveries"] ?? "-" ?></td>
    <td><?= $row["order_date"] ?? "-" ?></td>
    <td><?= $row["delivery_date"] ?? "-" ?></td>
    <td><?= $row["compliant_orders"] ?? "-" ?></td>
    <td><?= $row["total_orders"] ?? "-" ?></td>
    <td><?= $row["emergency_orders"] ?? "-" ?></td>
    <td><?= $row["notes"] ?></td>
    <td><?= $row["created_at"] ?></td>
  </tr>
<?php endwhile; ?>
</table>

<script>
const ctx = document.getElementById('logisticsChart').getContext('2d');
const logisticsChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [
      {
        label: 'Target',
        backgroundColor: 'rgba(94, 156, 118, 0.7)',
        data: <?= json_encode($targets) ?>
      },
      {
        label: 'Actual',
        backgroundColor: 'rgba(142, 209, 173, 0.7)',
        data: <?= json_encode($actuals) ?>
      }
    ]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>

</body>
</html>

<?php $conn->close(); ?>
