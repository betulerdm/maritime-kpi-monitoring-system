<?php
include("config.php");

$list_sql = "SELECT * FROM kpi_health ORDER BY year DESC, quarter DESC";
$list_result = $conn->query($list_sql);

$chart_sql = "SELECT kpi_name, target_value, actual_value FROM kpi_health ORDER BY created_at DESC LIMIT 10";
$chart_result = $conn->query($chart_sql);

$labels = [];
$targets = [];
$actuals = [];

while ($row = $chart_result->fetch_assoc()) {
    $labels[] = $row['kpi_name'];
    $targets[] = floatval($row['target_value']);
    $actuals[] = floatval($row['actual_value']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Health & Injury KPI List</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial; background: #f6fbfd; padding: 20px; }
    h2 { text-align: center; color: #1e6078; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
      font-size: 14px;
    }
    th { background-color: #308ca7; color: white; }
    .button-area { text-align: center; margin: 20px 0; }
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

<h2>📊 Health & Injury KPI Chart (Last 10 Records)</h2>
<div class="chart-container">
  <canvas id="healthChart"></canvas>
</div>

<div class="button-area">
  <a href="dashboard.php">🏠 Home</a>
  <a href="health_injury_form.php">➕ New Entry</a>
</div>

<h2>📋 Registered Records</h2>
<table>
  <tr>
    <th>ID</th><th>KPI Name</th><th>Year</th><th>Quarter</th><th>Target</th><th>Actual</th><th>Unit</th>
    <th>Injuries</th><th>Treatments</th><th>Near Miss</th><th>Employees</th><th>Lost Days</th><th>Man-Hours</th>
    <th>Notes</th><th>Entry Date</th>
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
      <td><?= $row["injuries"] ?? "-" ?></td>
      <td><?= $row["treatments"] ?? "-" ?></td>
      <td><?= $row["nearmiss"] ?? "-" ?></td>
      <td><?= $row["employees"] ?? "-" ?></td>
      <td><?= $row["days"] ?? "-" ?></td>
      <td><?= $row["hours"] ?? "-" ?></td>
      <td><?= $row["notes"] ?></td>
      <td><?= $row["created_at"] ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<script>
const ctx = document.getElementById('healthChart').getContext('2d');
const healthChart = new Chart(ctx, {
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
