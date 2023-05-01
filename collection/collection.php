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

$source_file = $month . "/" . $day . ".csv";
$fp = fopen($source_file, 'a+b');
$post = sizeof(file($source_file));

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>
