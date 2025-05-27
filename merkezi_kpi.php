<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Central KPI Panel</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      color: #333;
    }
    .container {
      max-width: 1300px;
      margin: auto;
      padding: 30px 20px;
    }
    h1 {
      text-align: center;
      color: #1e6078;
      margin-bottom: 40px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    .card {
      background: white;
      border-left: 6px solid #00b894;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card.danger { border-color: #e74c3c; }
    .card.warning { border-color: #f1c40f; }
    .card.success { border-color: #2ecc71; }
    .card h3 {
      margin: 0 0 10px;
      font-size: 1.1rem;
      color: #2d3436;
    }
    .card p {
      margin: 5px 0;
      font-size: 0.95rem;
    }
    canvas {
      background: white;
      border-radius: 10px;
      padding: 15px;
    }
    .section-title {
      font-size: 1.3rem;
      color: #1e6078;
      margin-bottom: 15px;
      border-bottom: 2px solid #1e6078;
      padding-bottom: 5px;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <h1>📊 Central KPI Panel</h1>

    <div class="section-title">🔎 KPI Status Cards</div>
    <div class="grid">
      <div class="card success">
        <h3>Health KPI</h3>
        <p>Result: 93% ✅</p>
        <p>Target: 90%</p>
      </div>
      <div class="card danger">
        <h3>Technical KPI</h3>
        <p>Critical Failure: 22% ❌</p>
        <p>Target: 10%</p>
      </div>
      <div class="card warning">
        <h3>Logistics KPI</h3>
        <p>On-Time Delivery: 82% ⚠️</p>
        <p>Target: 90%</p>
      </div>
      <div class="card success">
        <h3>Audit KPI</h3>
        <p>Compliance: 88% ✅</p>
        <p>Target: 85%</p>
      </div>
      <div class="card danger">
        <h3>Incident KPI</h3>
        <p>Average Time: 8 days ❌</p>
        <p>Target: 5 days</p>
      </div>
    </div>

    <div class="section-title">📈 KPI Trend Chart (Sample)</div>
    <canvas id="trendChart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('trendChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['2023 Q1', 'Q2', 'Q3', 'Q4', '2024 Q1', 'Q2'],
        datasets: [
          {
            label: 'Technical KPI - Critical Failure Rate (%)',
            data: [18, 14, 17, 19, 22, 20],
            borderColor: '#e74c3c',
            backgroundColor: 'rgba(231, 76, 60, 0.1)',
            fill: true,
            tension: 0.3
          },
          {
            label: 'Logistics KPI - Delivery Rate (%)',
            data: [85, 88, 90, 86, 82, 84],
            borderColor: '#2ecc71',
            backgroundColor: 'rgba(46, 204, 113, 0.1)',
            fill: true,
            tension: 0.3
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return context.dataset.label + ': ' + context.formattedValue + '%';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });
  </script>
</body>
</html>
