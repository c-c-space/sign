<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$month = date("m");
$day = date("d");
$source_file = "log/". $month ."/". $day . ".csv";

$fp = fopen($source_file, 'a+b');

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
  <script src="../js/index.js" async></script>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="css/about.css" />
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="css/flash.css" />
  <link rel="stylesheet" href="css/submit.css" />
  <style type="text/css">
  header {
    mix-blend-mode: difference;
  }

  #js-button,
  #contents a {
    filter: invert();
  }
  </style>
</head>
