<?php
$month = "01";
$day = "01";
$title = "一月"

require('../function.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <script type="text/javascript">
  let thismonth = 1
  const endDate = 31
  </script>

  <link rel="stylesheet" href="../../style.css" />
  <link rel="stylesheet" href="../../css/all.css" />
  <link rel="stylesheet" href="../../css/flash.css" />
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

  <main>
    <?php require('../../php/viewall.php'); ?>
  </main>
  <script src="../../js/flash.js"></script>
  <script src="../../js/viewall.js"></script>

  <?php require('../now.php'); ?>
  <script src="../selectdate.js" async></script>
</body>
</html>
