<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Main Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('images/resim2.png');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
    }
    .overlay {
      background-color: rgba(0, 0, 0, 0.7);
      min-height: 100vh;
      padding: 40px 20px;
      position: relative;
    }
    .topnav {
      position: center;
      top: 0;
      right: 0;
      background: rgba(255, 255, 255, 0.1);
      padding: 18px 30px;
      border-bottom-left-radius: 12px;
      font-size: 1.1rem;
    }
    .topnav a {
      color: #00bfff;
      margin-left: 30px;
      text-decoration: none;
      font-weight: bold;
    }
    .topnav a:hover {
      color: white;
    }
    .container {
      max-width: 1200px;
      margin: auto;
    }
    .logo {
      text-align: center;
      margin-bottom: 30px;
    }
    .logo img {
      width: 180px;
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 2.2rem;
      color: rgb(255, 255, 255);
    }
    .summary-boxes {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    .summary {
      background-color: rgba(255, 255, 255, 0.1);
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 6px rgba(0,0,0,0.3);
    }
    .summary h3 {
      margin: 0;
      font-size: 1rem;
      color: #00bfff;
    }
    .summary p {
      font-size: 1.4rem;
      font-weight: bold;
      color: #fff;
      margin: 5px 0 0;
    }
    .section {
      margin-bottom: 40px;
      background-color: rgba(255, 255, 255, 0.08);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    .section h2 {
      border-bottom: 1px solid rgba(255, 255, 255, 0.3);
      padding-bottom: 10px;
      margin-bottom: 20px;
      color: #00bfff;
    }
    .form-grid, .kpi-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
    }
    .button {
      background-color: #00bfff;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
      color: #003366;
      box-shadow: 0 4px 6px rgba(0,0,0,0.2);
      transition: background-color 0.3s ease;
    }
    .button:hover {
      background-color: rgb(0, 111, 149);
      color: white;
    }
    .footer {
      text-align: center;
      margin-top: 60px;
      font-size: 0.9rem;
      opacity: 0.7;
    }
    .highlight-button {
      background-color: #f39c12 !important;
      color: #fff !important;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <div class="topnav">
      <a href="dashboard.php">Home</a>
      <a href="#">User</a>
      <a href="#">Support</a>
      <a href="logout.php">Logout</a>
    </div>
    <div class="container">
      <div class="logo">
        <img src="images/formlo.png" alt="Erdem Marine Logo">
      </div>
      <h1>⚡ Main Dashboard - Admin Panel</h1>

      <div class="summary-boxes">
        <div class="summary">
          <h3>Total KPI Entries</h3>
          <p>142</p>
        </div>
        <div class="summary">
          <h3>Critical KPIs</h3>
          <p>5</p>
        </div>
        <div class="summary">
          <h3>Entries Last 7 Days</h3>
          <p>24</p>
        </div>
      </div>

      <div class="section">
        <h2>📅 Operational Forms</h2>
        <div class="form-grid">
          <a href="suppliers_form.php" class="button">Supplier Form</a>
          <a href="orders_form.php" class="button">Order Form</a>
          <a href="complaints_landing.php" class="button">Complaint Form</a>
          <a href="performance_form.php" class="button">Performance Form</a>
        </div>
      </div>

      <div class="section">
        <h2>📊 KPI Modules</h2>
        <div class="kpi-grid">
          <a href="health_injury_form.php" class="button">+ Health KPI</a>
          <a href="audit_kpi_form.php" class="button">📊 Audit KPI</a>
          <a href="technical_kpi_form.php" class="button">⚙ Technical KPI</a>
          <a href="incident_kpi_form.php" class="button" style="background-color: #e74c3c; color: white;">Incident KPI</a>
          <a href="logistics_kpi_form.php" class="button" style="background-color: #2ecc71; color: white;">Logistics KPI</a>
        </div>
      </div>

      <div class="section">
        <h2>🔍 Central KPI Panel</h2>
        <a href="merkezi_kpi.php" class="button highlight-button">View All KPIs</a>
      </div>

      <div class="section">
        <h2>🎯 Performance Tracking</h2>
        <a href="performance_tracking.php" class="button highlight-button">Performance Tracking Panel</a>
      </div>

      <div class="section">
        <h2>📁 Document Management</h2>
        <a href="belge_yonetimi.php" class="button highlight-button">View / Upload Documents</a>
      </div>

      <div class="footer">
        &copy; 2025 Erdem Marine KPI Tracking System
      </div>
    </div>
  </div>
</body>
</html>
