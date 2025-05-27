<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Health & Injury KPI Entry</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3fdf6;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-image: url('images/sss.jpg');
      background-position: center;
    }
    .tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 30px;
    }
    .tab-button {
      background-color: #308ca7;
      color: white;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 6px;
    }
    .tab-button.active {
      background-color: #1e6078;
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
      background-color: #308ca7;
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

<h2 style="color:rgb(255, 255, 255);">🩺 Health & Injury KPI Entry</h2>

<div class="tabs">
  <button class="tab-button active" id="btn-tab1" onclick="showForm('tab1')">📉 LTIF</button>
  <button class="tab-button" id="btn-tab2" onclick="showForm('tab2')">🩹 MTCR</button>
  <button class="tab-button" id="btn-tab3" onclick="showForm('tab3')">⚠️ Near Miss</button>
  <button class="tab-button" id="btn-tab4" onclick="showForm('tab4')">📆 Days Away</button>
</div>

<div class="nav-links">
  <a href="dashboard.php">🏠 Home</a>
  <a href="health_kpi_list.php">📋 View Saved Records</a>
</div>

<!-- TAB 1: LTIF -->
<div id="tab1" class="form-section active">
  <form action="health_injury_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="ltif">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Number of Lost Time Injuries:</label>
    <input type="number" name="injuries" required>
    <label>Total Man-Hours:</label>
    <input type="number" name="hours" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" placeholder="e.g. 3.2" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<!-- TAB 2: MTCR -->
<div id="tab2" class="form-section">
  <form action="health_injury_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="mtcr">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Number of Medical Treatments:</label>
    <input type="number" name="treatments" required>
    <label>Total Man-Hours:</label>
    <input type="number" name="hours" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<!-- TAB 3: Near Miss -->
<div id="tab3" class="form-section">
  <form action="health_injury_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="nearmiss">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Number of Near Misses:</label>
    <input type="number" name="nearmiss" required>
    <label>Total Number of Employees:</label>
    <input type="number" name="employees" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<!-- TAB 4: Days Away -->
<div id="tab4" class="form-section">
  <form action="health_injury_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="daysaway">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Days Away From Work:</label>
    <input type="number" name="days" required>
    <label>Total Man-Hours:</label>
    <input type="number" name="hours" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<script>showForm('tab1');</script>
</body>
</html>