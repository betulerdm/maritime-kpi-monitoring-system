<?php
session_start();
if(!isset($_SESSION['kullanici_adi'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Performance - Erdem Marine</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background-image: url('images/PERFBACK.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      color: white;
    }
    .tabs {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }
    .tab {
      background-color: rgba(0,0,0,0.6);
      color: white;
      padding: 15px 30px;
      cursor: pointer;
      border-radius: 10px 10px 0 0;
      margin: 0 10px;
      transition: 0.3s;
    }
    .tab:hover, .tab.active {
      background-color: #00bfff;
    }
    .tab-content {
      display: none;
      background-color: rgba(0,0,0,0.7);
      padding: 40px;
      max-width: 1200px;
      margin: auto;
      border-radius: 0 0 10px 10px;
    }
    .tab-content.active {
      display: block;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: none;
    }
    button {
      background-color: #00bfff;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      margin-top: 15px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background-color: #007bb5;
    }

    .kpi-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }
    .kpi-card {
      background-color: white;
      color: black;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      text-align: center;
    }
    .kpi-card canvas {
      max-width: 100%;
      height: 250px !important;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="tabs">
  <div class="tab active" onclick="showTab('form')">Performance Evaluation</div>
  <div class="tab" onclick="showTab('kpi')">Performance Tracking</div>
</div>

<div id="form" class="tab-content active">
  <h2>Performance Evaluation Form</h2>
  <form action="performance_kaydet.php" method="post">

    <label>Personnel Name:</label>
    <input type="text" name="personel_adi" required>

    <label>Department:</label>
    <input type="text" name="departman" required>

    <label>Supplier:</label>
    <input type="text" name="tedarikci" required>

    <label>Order No:</label>
    <input type="text" name="siparis_no" required>

    <label>Delivery Time (days):</label>
    <input type="number" name="teslim_suresi" required>

    <label>On-Time Delivery:</label>
    <select name="zamaninda_teslim" required>
      <option value="evet">Yes</option>
      <option value="hayır">No</option>
    </select>

    <label>Quality Status:</label>
    <select name="kalite_durumu" required>
      <option value="Uygun">Acceptable</option>
      <option value="Uygun Değil">Unacceptable</option>
    </select>

    <label>Number of Complaints:</label>
    <input type="number" name="sikayet_sayisi" required>

    <label>Overall Performance:</label>
    <input type="text" name="performans_durumu" required>

    <label>Evaluation Date:</label>
    <input type="date" name="degerlendirme_tarihi" required>

    <label>Comment:</label>
    <textarea name="yorum" rows="4"></textarea>

    <button type="submit">Save</button>
  </form>
</div>

<div id="kpi" class="tab-content">
  <h2>Performance Tracking (KPI)</h2>
  <div class="kpi-grid">
    <div class="kpi-card">
      <h3>Average Delivery Time</h3>
      <canvas id="deliveryChart"></canvas>
    </div>
    <div class="kpi-card">
      <h3>Quality Ratio</h3>
      <canvas id="qualityChart"></canvas>
    </div>
    <div class="kpi-card">
      <h3>On-Time Delivery (%)</h3>
      <canvas id="zamanindaChart"></canvas>
    </div>
    <div class="kpi-card">
      <h3>Average Complaint Count</h3>
      <canvas id="sikayetChart"></canvas>
    </div>
  </div>
</div>

<script>
function showTab(id) {
  document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  document.querySelector(`.tab[onclick="showTab('${id}')"]`).classList.add('active');
}

window.onload = function () {
  fetch('kpi_verileri.php')
    .then(res => res.json())
    .then(data => {
      new Chart(document.getElementById("deliveryChart"), {
        type: 'bar',
        data: {
          labels: ["Average Delivery Time"],
          datasets: [{ label: "Days", data: [data.ortalama_teslim_suresi], backgroundColor: '#00bfff' }]
        }
      });
      new Chart(document.getElementById("qualityChart"), {
        type: 'doughnut',
        data: {
          labels: ["Acceptable", "Unacceptable"],
          datasets: [{ data: [data.kalite_uygun_oran, 100 - data.kalite_uygun_oran], backgroundColor: ['#00bfff', '#ff4d4d'] }]
        }
      });
      new Chart(document.getElementById("zamanindaChart"), {
        type: 'pie',
        data: {
          labels: ["On Time", "Late"],
          datasets: [{ data: [data.zamaninda_teslim_oran, 100 - data.zamaninda_teslim_oran], backgroundColor: ['#28a745', '#ffc107'] }]
        }
      });
      new Chart(document.getElementById("sikayetChart"), {
        type: 'bar',
        data: {
          labels: ["Average Complaint Count"],
          datasets: [{ label: "Count", data: [data.ortalama_sikayet], backgroundColor: '#dc3545' }]
        }
      });
    })
    .catch(error => console.error("KPI data could not be loaded:", error));
};
</script>

</body>
</html>
