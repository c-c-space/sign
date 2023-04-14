<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$year = date("Y");
$month = date("m");

$day = date("d");

$source_file = "log/". $month ."/". $day . ".csv";
$fp = fopen($source_file, 'a+b');

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>
