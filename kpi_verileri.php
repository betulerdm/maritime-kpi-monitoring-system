<?php
include "config.php";


$res1 = $baglan->query("SELECT AVG(teslim_suresi) as ortalama_teslim FROM performance_evaluations");
$ortalama_teslim = $res1->fetch_assoc()['ortalama_teslim'] ?? 0;


$res2 = $baglan->query("SELECT COUNT(*) as toplam, SUM(kalite_durumu = 'Uygun') as uygun_sayisi FROM performance_evaluations");
$row2 = $res2->fetch_assoc();
$kalite_oran = $row2['toplam'] > 0 ? ($row2['uygun_sayisi'] / $row2['toplam']) * 100 : 0;


$res3 = $baglan->query("SELECT COUNT(*) as toplam, SUM(zamaninda_teslim = 'Evet') as zamaninda FROM performance_evaluations");
$row3 = $res3->fetch_assoc();
$teslim_oran = $row3['toplam'] > 0 ? ($row3['zamaninda'] / $row3['toplam']) * 100 : 0;


$res4 = $baglan->query("SELECT AVG(sikayet_sayisi) as ortalama_sikayet FROM performance_evaluations");
$ortalama_sikayet = $res4->fetch_assoc()['ortalama_sikayet'] ?? 0;


echo json_encode([
  "ortalama_teslim_suresi" => round($ortalama_teslim, 2),
  "kalite_uygun_oran" => round($kalite_oran, 2),
  "zamaninda_teslim_oran" => round($teslim_oran, 2),
  "ortalama_sikayet" => round($ortalama_sikayet, 2)
]);
?>
