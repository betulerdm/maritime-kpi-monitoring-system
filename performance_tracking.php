<?php
include("config.php");

$sql = "SELECT 
    MONTH(degerlendirme_tarihi) AS month,
    ROUND(AVG(teslim_suresi), 2) AS avg_delivery_time,
    ROUND(AVG(sikayet_sayisi), 2) AS avg_complaints,
    ROUND(SUM(CASE WHEN zamaninda_teslim = 1 THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 1) AS ontime_delivery_rate,
    ROUND(SUM(CASE WHEN kalite_durumu = 'Uygun' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 1) AS quality_rate
FROM performance_evaluations
GROUP BY month
ORDER BY month";

$result = mysqli_query($baglan, $sql);
$data = [];
while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Performance KPI Tracking</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color:rgb(227, 227, 227);
        }
        body {
            background-image: url('images/sea.png');
            font-family: Arial;
            margin: 20px;
        }
        .excel-button {
            background-color: #007bff;
            color: white;
            padding: 14px 28px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }
        .excel-button:hover {
            background-color: #0056b3;
        }
        .commentary {
            background: rgba(255,255,255,0.8);
            padding: 15px;
            border-radius: 10px;
            margin-top: 30px;
            font-size: 16px;
            color: #000;
        }
    </style>
</head>
<body>

<h2>📊 Monthly KPI Table</h2>
<table id="kpiTable">
    <tr>
        <th>Month</th>
        <th>Avg. Delivery Time</th>
        <th>Avg. Complaints</th>
        <th>On-Time Delivery (%)</th>
        <th>Quality Rate (%)</th>
    </tr>
    <?php foreach ($data as $row): ?>
    <tr>
        <td><?= $row['month'] ?></td>
        <td><?= $row['avg_delivery_time'] ?></td>
        <td><?= $row['avg_complaints'] ?></td>
        <td><?= $row['ontime_delivery_rate'] ?></td>
        <td><?= $row['quality_rate'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>📈 KPI Chart</h2>
<canvas id="kpiChart" height="100"></canvas>

<script>
const ctx = document.getElementById('kpiChart').getContext('2d');
const data = <?= json_encode($data); ?>;

const labels = data.map(d => "Month " + d.month);
const delivery = data.map(d => d.avg_delivery_time);
const complaints = data.map(d => d.avg_complaints);
const ontime = data.map(d => d.ontime_delivery_rate);
const quality = data.map(d => d.quality_rate);

const deliveryTarget = 3.0;
const deliveryColor = delivery.map(v => v > deliveryTarget ? 'red' : 'green');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Delivery Time',
                data: delivery,
                backgroundColor: deliveryColor
            },
            {
                label: 'Complaints',
                data: complaints,
                backgroundColor: 'orange'
            },
            {
                label: 'On-Time Delivery (%)',
                data: ontime,
                type: 'line',
                borderColor: 'green',
                fill: false
            },
            {
                label: 'Quality Rate (%)',
                data: quality,
                type: 'line',
                borderColor: 'blue',
                fill: false
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Performance KPI Chart'
            },
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

<div class="commentary">
    <h3>📌 Monthly Comments</h3>
    <ul>
        <?php foreach ($data as $row): ?>
            <li>
                <strong>Month <?= $row['month'] ?>:</strong>
                <?php
                    $comment = [];
                    if ($row['avg_delivery_time'] > 5) $comment[] = "High delivery time";
                    if ($row['avg_complaints'] > 2) $comment[] = "Increased complaints";
                    if ($row['ontime_delivery_rate'] < 50) $comment[] = "Low on-time delivery rate";
                    if ($row['quality_rate'] < 70) $comment[] = "Low quality level";
                    echo empty($comment) ? "Performance is normal." : implode(", ", $comment) . ".";
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<button class="excel-button" onclick="exportTableToExcel('kpiTable', 'kpi-data')">Download as Excel</button>

<script>
function exportTableToExcel(tableID, filename = ''){
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    filename = filename ? filename + '.xls' : 'excel_data.xls';

    var downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>

</body>
</html>
