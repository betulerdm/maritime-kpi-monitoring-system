<?php
// config.php included
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Management Panel</title>
  <style>
    body { font-family: Arial; background-color: #f3f7fb; margin: 0; padding: 30px; color: #333; }
    h1 { text-align: center; color: #1e6078; }
    form { background: white; padding: 20px; border-radius: 10px; max-width: 700px; margin: auto; box-shadow: 0 4px 8px rgba(0,0,0,0.05); margin-bottom: 40px; }
    label { font-weight: bold; display: block; margin-top: 15px; }
    input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
    button { margin-top: 20px; background-color: #1e6078; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
    table { width: 100%; border-collapse: collapse; margin-top: 40px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    th { background-color: #1e6078; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>

<h1>📂 Document Management Panel</h1>

<form action="belge_yukle.php" method="POST" enctype="multipart/form-data">
  <label>Document Name:</label>
  <input type="text" name="belge_adi" required>

  <label>Category:</label>
  <select name="kategori" required>
    <option value="Gemi Sertifikası">Ship Certificate</option>
    <option value="Personel Belgesi">Personnel Document</option>
    <option value="Denetim Raporu">Audit Report</option>
    <option value="İş Sağlığı / Güvenlik">Occupational Health / Safety</option>
  </select>

  <label>Upload Date:</label>
  <input type="date" name="yuklenme_tarihi" required>

  <label>Expiration Date:</label>
  <input type="date" name="gecerlilik_tarihi">

  <label>File:</label>
  <input type="file" name="belge_dosya" required>

  <button type="submit">Upload Document</button>
</form>

<?php
$result = $conn->query("SELECT * FROM belgeler ORDER BY yuklenme_tarihi DESC");
if ($result->num_rows > 0):
?>
<table>
  <tr>
    <th>Document Name</th>
    <th>Category</th>
    <th>Uploaded</th>
    <th>Valid Until</th>
    <th>Download</th>
  </tr>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['belge_adi']) ?></td>
      <td><?= htmlspecialchars($row['kategori']) ?></td>
      <td><?= $row['yuklenme_tarihi'] ?></td>
      <td><?= $row['gecerlilik_tarihi'] ?? '-' ?></td>
      <td><a href="uploads/<?= $row['dosya_yolu'] ?>" target="_blank">📄</a></td>
    </tr>
  <?php endwhile; ?>
</table>
<?php else: ?>
  <p style="text-align:center;">No documents uploaded yet.</p>
<?php endif; ?>

</body>
</html>
