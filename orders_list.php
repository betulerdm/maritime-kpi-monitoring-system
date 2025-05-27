<?php
include "config.php";

// Filtering control
$filter = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $filter = "WHERE siparis_no LIKE '%$search%' OR tedarikci_id LIKE '%$search%'";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f8ff;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #003366;
    }

    form {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 8px;
      width: 60%;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn {
      background-color: #00bfff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      margin-left: 10px;
    }

    .btn:hover {
      background-color: #007bb5;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      padding: 10px 15px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #003366;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .action-buttons a {
      margin: 0 5px;
      padding: 5px 10px;
      background-color: #00bfff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
    }

    .action-buttons a:hover {
      background-color: #007bb5;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Order List</h2>

  <!-- Search and New Entry -->
  <form method="GET">
    <input type="text" name="search" placeholder="Search by Order No or Supplier ID..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
    <div>
      <button class="btn" type="submit" name="search">Search</button>
      <a href="orders_form.php" class="btn">+ New Order</a>
    </div>
  </form>

  <!-- Orders Table -->
  <table>
    <tr>
      <th>ID</th>
      <th>Supplier ID</th>
      <th>Order No</th>
      <th>Request Date</th>
      <th>Delivered</th>
      <th>Delivery Date</th>
      <th>Urgent</th>
      <th>Actions</th>
    </tr>

    <?php
    $sql = "SELECT * FROM orders $filter ORDER BY id DESC";
    $result = $baglan->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['tedarikci_id']}</td>
                    <td>{$row['siparis_no']}</td>
                    <td>{$row['talep_tarihi']}</td>
                    <td>{$row['teslim_edildi']}</td>
                    <td>{$row['teslim_tarihi']}</td>
                    <td>{$row['acil']}</td>
                    <td class='action-buttons'>
                      <a href='orders_update.php?id={$row['id']}'>Update</a>
                      <a href='orders_delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this?')\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No records found.</td></tr>";
    }
    ?>
  </table>
</div>

</body>
</html>
