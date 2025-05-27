<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api']) && $_GET['api'] === 'list') {
    header("Content-Type: application/json");
    $sql = "SELECT * FROM audit_kpi ORDER BY created_at DESC LIMIT 50";
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    $conn->close();
    exit;
}

$chart_sql = "SELECT kpi_type, target_value, actual_value FROM audit_kpi ORDER BY created_at DESC LIMIT 10";
$chart_result = $conn->query($chart_sql);

$labels = [];
$targets = [];
$actuals = [];

while ($row = $chart_result->fetch_assoc()) {
    $labels[] = $row['kpi_type'];
    $targets[] = floatval($row['target_value']);
    $actuals[] = floatval($row['actual_value']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Audit & Inspection KPI Record List</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial; background: #f6fbfd; padding: 20px; text-align: center; }
    h2 { color: #1e6078; }
    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 95%;
      max-width: 1200px;
      background: white;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
      font-size: 14px;
    }
    th {
      background-color: #308ca7;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #e6f0f5;
    }
    .button-area {
      text-align: center;
      margin: 20px 0;
    }
    .button-area a {
      background-color: #308ca7;
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

<h2>📊 Audit & Inspection KPI Chart (Last 10 Records)</h2>
<div class="chart-container">
  <canvas id="auditChart"></canvas>
</div>

<div class="button-area">
  <a href="dashboard.php">🏠 Home</a>
  <a href="audit_kpi_form.php">➕ New Entry</a>
</div>

<h2>📋 KPI Records</h2>
<table>
  <tr>
    <th>ID</th><th>KPI Name</th><th>Year</th><th>Quarter</th><th>Target</th><th>Actual</th><th>Unit</th><th>Note</th><th>Created At</th>
  </tr>
  <?php
  $list_sql = "SELECT * FROM audit_kpi ORDER BY year DESC, quarter DESC";
  $list_result = $conn->query($list_sql);
  while ($row = $list_result->fetch_assoc()): ?>
  <tr>
    <td><?= $row["id"] ?></td>
    <td><?= $row["kpi_type"] ?></td>
    <td><?= $row["year"] ?></td>
    <td><?= $row["quarter"] ?></td>
    <td><?= $row["target_value"] ?></td>
    <td><?= $row["actual_value"] ?></td>
    <td><?= $row["unit"] ?></td>
    <td><?= $row["notes"] ?></td>
    <td><?= $row["created_at"] ?></td>
  </tr>
  <?php endwhile; ?>
</table>

<script>
const ctx = document.getElementById('auditChart').getContext('2d');
const auditChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [
      {
        label: 'Target',
        backgroundColor: 'rgba(49, 138, 165, 0.7)',
        data: <?= json_encode($targets) ?>
      },
      {
        label: 'Actual',
        backgroundColor: 'rgba(128, 200, 224, 0.7)',
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
