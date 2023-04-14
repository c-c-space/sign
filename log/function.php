<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$source_file = $day . ".csv";
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

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <link rel="stylesheet" href="../../style.css" />
  <link rel="stylesheet" href="../../css/all.css" />
  <link rel="stylesheet" href="../../css/flash.css" />
  <style type="text/css">
  html {
    height: -webkit-fill-available;
  }

  body {
    min-height: -webkit-fill-available;
  }
  </style>
</head>

<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)) : ?>
  <?php foreach ($rows as $row) : ?>
  #<?= h($row[1]) ?>,
  <?php endforeach; ?>
  <?php else : ?>
  #000,
  <?php endif; ?>
  #fff);">
