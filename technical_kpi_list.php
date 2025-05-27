<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api']) && $_GET['api'] === 'list') {
    header("Content-Type: application/json");
    $sql = "SELECT * FROM technical_kpi ORDER BY created_at DESC LIMIT 50";
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    $conn->close();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Technical KPI Record List</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial; background: #f3fdf6; padding: 20px; text-align: center; }
    h2 { color: #1e6078; }
    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 95%;
      max-width: 1200px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #308ca7;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #e6f0f5;
    }
    #chartContainer {
      width: 95%;
      max-width: 1000px;
      margin: 40px auto;
    }
  </style>
</head>
<body>

<h2>📊 Technical KPI Records</h2>

<table id="kpiTable">
  <thead>
    <tr>
      <th>Year</th>
      <th>Quarter</th>
      <th>KPI Type</th>
      <th>Actual (%)</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>

<div id="chartContainer">
  <canvas id="kpiChart"></canvas>
</div>

<script>
const tbody = document.querySelector("#kpiTable tbody");
const ctx = document.getElementById("kpiChart").getContext("2d");
let chart;

function loadData() {
  fetch('?api=list')
    .then(res => res.json())
    .then(data => {
      fillTable(data);
      drawChart(data);
    })
    .catch(err => {
      console.error("Failed to load data:", err);
    });
}

function fillTable(data) {
  tbody.innerHTML = '';
  if (data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5">No records found.</td></tr>';
    return;
  }

  data.forEach(item => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${item.year}</td>
      <td>${item.quarter}</td>
      <td>${item.kpi_type.replace(/_/g, ' ')}</td>
      <td>${parseFloat(item.actual_value).toFixed(2)}</td>
      <td>${item.notes ?? ''}</td>
    `;
    tbody.appendChild(row);
  });
}

function drawChart(data) {
  if (chart) chart.destroy();

  const labels = data.map(d => `${d.year} ${d.quarter}`);
  const values = data.map(d => parseFloat(d.actual_value));
  const types = data.map(d => d.kpi_type);

  chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Actual KPI Value (%)',
        data: values,
        backgroundColor: 'rgba(48,140,167,0.6)',
        borderColor: 'rgba(48,140,167,1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          title: { display: true, text: 'Actual Value (%)' }
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            afterLabel: (ctx) => `KPI: ${types[ctx.dataIndex].replace(/_/g, ' ')}`
          }
        }
      }
    }
  });
}

window.onload = loadData;
</script>

</body>
</html>
