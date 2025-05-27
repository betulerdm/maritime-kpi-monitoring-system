<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logistics KPI Entry (Tabbed)</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3fdf6;
      padding: 30px;
      background-position: center;
      flex-direction: column;
      align-items: center;
      background-image: url('images/sdw.jpg');
    }
    .tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 30px;
    }
    .tab-button {
      background-color: #5e9c76;
      color: white;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 6px;
    }
    .tab-button.active {
      background-color: #407a58;
    }
    .form-section {
      display: none;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 700px;
      margin: auto;
    }
    .form-section.active {
      display: block;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button.submit {
      background-color: #5e9c76;
      color: white;
      padding: 12px 18px;
      border: none;
      border-radius: 6px;
      margin-top: 20px;
      cursor: pointer;
    }
    .nav-links {
      text-align: center;
      margin-bottom: 25px;
    }
    .nav-links a {
      color:rgb(255, 255, 255);
      text-decoration: none;
      font-weight: bold;
      margin: 0 12px;
    }
  </style>
  <script>
    function showForm(tabId) {
      const sections = document.querySelectorAll('.form-section');
      const buttons = document.querySelectorAll('.tab-button');
      sections.forEach(s => s.classList.remove('active'));
      buttons.forEach(b => b.classList.remove('active'));
      document.getElementById(tabId).classList.add('active');
      document.getElementById('btn-' + tabId).classList.add('active');
    }
  </script>
</head>
<body>
<h2 style="color: rgb(255, 255, 255); text-align: center;">🚚 Logistics KPI Tracking Panel</h2>

<div class="tabs">
  <button class="tab-button active" id="btn-tab1" onclick="showForm('tab1')">📦 On-Time Delivery</button>
  <button class="tab-button" id="btn-tab2" onclick="showForm('tab2')">⏱️ Procurement Time</button>
  <button class="tab-button" id="btn-tab3" onclick="showForm('tab3')">✅ Supplier Compliance</button>
  <button class="tab-button" id="btn-tab4" onclick="showForm('tab4')">🚨 Emergency Ratio</button>
</div>
<div class="nav-links">
  <a href="dashboard.php">🏠 Home</a>
  <a href="logistics_kpi_list.php">📋 View Records</a>
</div>

<!-- TAB 1 -->
<div id="tab1" class="form-section active">
  <form action="logistics_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="ontime_delivery">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>On-Time Deliveries:</label>
    <input type="number" name="ontime" required>
    <label>Total Deliveries:</label>
    <input type="number" name="total" required>
    <label>Target Value (%):</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
    <div class="bottom-link">
            <a href="logistics_kpi_list.php">📋 View Records</a>
        </div>
  </form>
</div>

<!-- TAB 2 -->
<div id="tab2" class="form-section">
  <form action="logistics_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="procurement_time">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Order Date:</label>
    <input type="date" name="order_date" required>
    <label>Delivery Date:</label>
    <input type="date" name="delivery_date" required>
    <label>Target Duration (days):</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
    <div class="bottom-link">
            <a href="logistics_kpi_list.php">📋 View Records</a>
        </div>
  </form>
</div>

<!-- TAB 3 -->
<div id="tab3" class="form-section">
  <form action="logistics_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="supplier_compliance">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Compliant Orders:</label>
    <input type="number" name="compliant" required>
    <label>Total Orders:</label>
    <input type="number" name="total" required>
    <label>Target Value (%):</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
    <div class="bottom-link">
            <a href="logistics_kpi_list.php">📋 View Records</a>
        </div>
  </form>
</div>

<!-- TAB 4 -->
<div id="tab4" class="form-section">
  <form action="logistics_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="emergency_ratio">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Emergency Purchases:</label>
    <input type="number" name="emergency" required>
    <label>Total Purchases:</label>
    <input type="number" name="total" required>
    <label>Target Value (%):</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
    <div class="bottom-link">

        </div>
  </form>
</div>

<script>showForm('tab1');</script>
</body>
</html>
