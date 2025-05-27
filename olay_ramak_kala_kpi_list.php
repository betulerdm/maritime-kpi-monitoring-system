<?php
// olay_ramak_kala_kpi_list.php

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['api']) && $_GET['api'] === 'list') {
    header("Content-Type: application/json");
    $sql = "SELECT * FROM olay_ramak_kala_kpi ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Incident & Near Miss KPI Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3fdf6;
      margin: 20px;
      color: #1e6078;
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
    }
    table {
      border-collapse: collapse;
      width: 95%;
      max-width: 1100px;
      margin: 0 auto 40px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px 15px;
      font-size: 0.9rem;
      text-align: center;
      vertical-align: middle;
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
      max-width: 1100px;
      margin: 0 auto;
    }
  </style>
</head>
<body>

  <h2>Incident & Near Miss KPI Record List</h2>

  <table aria-label="KPI Record Table" id="kpiTable">
    <thead>
      <tr>
        <th>Year</th>
        <th>Quarter</th>
        <th>Near Miss Count</th>
        <th>Target</th>
        <th>Reported Incidents</th>
        <th>Target</th>
        <th>Investigated Incidents</th>
        <th>Investigation Rate (%)</th>
        <th>Target</th>
        <th>Closure Time (days)</th>
        <th>Target</th>
        <th>Notes</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <div id="chartContainer">
    <canvas id="kpiChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const tbody = document.querySelector("#kpiTable tbody");
    const ctx = document.getElementById("kpiChart").getContext("2d");
    let kpiChart;

    function loadData() {
      fetch('?api=list')
        .then(res => res.json())
        .then(data => {
          fillTable(data);
          drawChart(data);
        })
        .catch(err => {
          alert('Error loading data!');
          console.error(err);
        });
    }

    function fillTable(data) {
      tbody.innerHTML = '';
      if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="12">No records found.</td></tr>';
        return;
      }
      data.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.year}</td>
          <td>${item.quarter}</td>
          <td>${item.near_miss_count}</td>
          <td>${item.near_miss_target ?? ''}</td>
          <td>${item.reported_incidents}</td>
          <td>${item.reported_target ?? ''}</td>
          <td>${item.investigated_incidents}</td>
          <td>${parseFloat(item.investigation_rate).toFixed(2)}</td>
          <td>${item.investigation_target ?? ''}</td>
          <td>${parseFloat(item.closing_time).toFixed(2)}</td>
          <td>${item.closing_target ?? ''}</td>
          <td>${item.notes ? item.notes : ''}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    function drawChart(data) {
      if (kpiChart) kpiChart.destroy();

      const labels = data.map(d => d.year + ' ' + d.quarter);
      const investigationRates = data.map(d => parseFloat(d.investigation_rate));
      const investigationTargets = data.map(d => parseFloat(d.investigation_target) || 0);
      const closingTimes = data.map(d => parseFloat(d.closing_time));
      const closingTargets = data.map(d => parseFloat(d.closing_target) || 0);

      kpiChart = new Chart(ctx, {
        data: {
          labels: labels,
          datasets: [
            {
              type: 'line',
              label: 'Investigation Rate (%)',
              data: investigationRates,
              borderColor: 'rgba(48,140,167,1)',
              backgroundColor: 'rgba(48,140,167,0.3)',
              yAxisID: 'y',
              tension: 0.3,
              fill: true,
            },
            {
              type: 'line',
              label: 'Investigation Target (%)',
              data: investigationTargets,
              borderColor: 'rgba(48, 167, 167, 0.6)',
              borderDash: [5,5],
              yAxisID: 'y',
              tension: 0.3,
              fill: false,
            },
            {
              type: 'bar',
              label: 'Closure Time (days)',
              data: closingTimes,
              backgroundColor: 'rgba(49,174,95,0.7)',
              yAxisID: 'y1',
            },
            {
              type: 'bar',
              label: 'Closure Target (days)',
              data: closingTargets,
              backgroundColor: 'rgba(49,174,95,0.3)',
              yAxisID: 'y1',
            }
          ]
        },
        options: {
          responsive: true,
          interaction: {
            mode: 'index',
            intersect: false,
          },
          scales: {
            y: {
              type: 'linear',
              display: true,
              position: 'left',
              beginAtZero: true,
              title: {
                display: true,
                text: 'Investigation Rate (%)'
              }
            },
            y1: {
              type: 'linear',
              display: true,
              position: 'right',
              beginAtZero: true,
              grid: {
                drawOnChartArea: false,
              },
              title: {
                display: true,
                text: 'Closure Time (days)'
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
