<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Incident & Near Miss KPI Entry</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3fdf6;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-image: url('images/bd.jpg');
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
      box-sizing: border-box;
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

    function calculateRate(event) {
      event.preventDefault();
      const form = event.target.form;
      const investigated = Number(form.investigated_incidents.value);
      const reported = Number(form.reported_incidents.value);
      if (reported === 0) {
        alert("Reported incidents cannot be 0.");
        return false;
      }
      const rate = (investigated / reported) * 100;
      form.investigation_rate.value = rate.toFixed(2);
      form.submit();
    }
    showForm('tab1');
  </script>
</head>
<body>
<h2 style="color:rgb(255, 255, 255);">⚠️ Incident & Near Miss KPI Entry</h2>

<div class="tabs">
  <button class="tab-button active" id="btn-tab1" onclick="showForm('tab1')">Near Miss Count</button>
  <button class="tab-button" id="btn-tab2" onclick="showForm('tab2')">Reported Incidents</button>
  <button class="tab-button" id="btn-tab3" onclick="showForm('tab3')">Investigation Rate</button>
  <button class="tab-button" id="btn-tab4" onclick="showForm('tab4')">Incident Closing Time</button>
</div>

<div class="nav-links">
  <a href="dashboard.php">🏠 Home</a>
  <a href="olay_ramak_kala_kpi_list.php">📋 View Saved Records</a>
</div>

<!-- TAB 1: Near Miss Count -->
<div id="tab1" class="form-section active">
  <form action="olay_ramak_kala_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="near_miss_count">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Near Miss Count:</label>
    <input type="number" name="near_miss_count" min="0" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" placeholder="e.g. 10" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<!-- TAB 2: Reported Incidents -->
<div id="tab2" class="form-section">
  <form action="olay_ramak_kala_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="reported_incidents">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Reported Incidents:</label>
    <input type="number" name="reported_incidents" min="0" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" placeholder="e.g. 20" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

<!-- TAB 3: Investigation Rate -->
<div id="tab3" class="form-section">
  <form action="olay_ramak_kala_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="investigation_rate">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Investigated Incidents:</label>
    <input type="number" name="investigated_incidents" min="0" required>
    <label>Reported Incidents:</label>
    <input type="number" name="reported_incidents" min="0" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" placeholder="e.g. 80" required>
    <label>Investigation Rate (%):</label>
    <input type="text" name="investigation_rate" readonly>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit" onclick="calculateRate(event)">Save</button>
  </form>
</div>

<!-- TAB 4: Incident Closing Time -->
<div id="tab4" class="form-section">
  <form action="olay_ramak_kala_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="closing_time">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Incident Closing Time (days):</label>
    <input type="number" step="0.1" min="0" name="closing_time" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" placeholder="e.g. 5" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Save</button>
  </form>
</div>

</body>
</html>
