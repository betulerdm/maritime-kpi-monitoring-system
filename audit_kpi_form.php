<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <title>Audit & Inspection KPI Girişi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3fdf6;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
       background-size: cover;
      background-image: url('images/sikayet_gemi.png');

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
  </script>
</head>
<body>
<h2 style="color: rgb(255, 255, 255);">🔍 Audit & Inspection KPI Entry</h2>

<div class="tabs">
  <button class="tab-button active" id="btn-tab1" onclick="showForm('tab1')">Audit Score</button>
  <button class="tab-button" id="btn-tab2" onclick="showForm('tab2')">Inspection Score</button>
  <button class="tab-button" id="btn-tab3" onclick="showForm('tab3')">Compliance Score</button>
  <button class="tab-button" id="btn-tab4" onclick="showForm('tab4')">Other Score</button>
</div>

<div class="nav-links">
  <a href="dashboard.php">🏠 Home</a>
  <a href="audit_kpi_list.php">📋 View Saved Records</a>
</div>

<!-- TAB 1: Audit Score -->
<div id="tab1" class="form-section active">
  <form action="audit_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="audit_score">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Achieved Score :</label>
    <input type="number" name="score" required>
    <label> Maximum Score :</label>
    <input type="number" name="max_score" required>
    <label>Target Value </label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Kaydet</button>
  </form>
</div>

<!-- TAB 2: Inspection Score -->
<div id="tab2" class="form-section">
  <form action="audit_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="inspection_score">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Achieved Score :</label>
    <input type="number" name="score" required>
    <label>Maximum Score:</label>
    <input type="number" name="max_score" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Kaydet</button>
  </form>
</div>

<!-- TAB 3: Compliance Score -->
<div id="tab3" class="form-section">
  <form action="audit_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="compliance_score">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Achieved Score</label>
    <input type="number" name="score" required>
    <label>Maximum Score:</label>
    <input type="number" name="max_score" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Kaydet</button>
  </form>
</div>

<!-- TAB 4: Other Score -->
<div id="tab4" class="form-section">
  <form action="audit_kpi_kaydet.php" method="POST">
    <input type="hidden" name="kpi_type" value="other_score">
    <label>Year:</label>
    <input type="number" name="year" required>
    <label>Quarter:</label>
    <select name="quarter" required>
      <option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>
    </select>
    <label>Achieved Score:</label>
    <input type="number" name="score" required>
    <label>Maximum Score:</label>
    <input type="number" name="max_score" required>
    <label>Target Value:</label>
    <input type="text" name="target_value" required>
    <label>Notes:</label>
    <textarea name="notes"></textarea>
    <button type="submit" class="submit">Kaydet</button>
  </form>
</div>

<script>
  function showForm(tabId) {
    const sections = document.querySelectorAll('.form-section');
    const buttons = document.querySelectorAll('.tab-button');
    sections.forEach(s => s.classList.remove('active'));
    buttons.forEach(b => b.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
    document.getElementById('btn-' + tabId).classList.add('active');
  }
  showForm('tab1');
</script>

</body>
</html>
