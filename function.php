<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$year = date("Y");
$month = date("m");

$day = date("d");
if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$source_file = "log/". $month ."/". $day . ".csv";
$fp = fopen($source_file, 'a+b');

$post = sizeof(file($source_file));

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$title = date("n") .'月'. $day .'日の気持ちを知る・表す';
$description = $post .'の色と記号';

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>
