<?php
$title = '令和三年六月';
$year = "2021";
$month = "06";

require('../function.php');
?>

<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)):?>
  <?php foreach ($rows as $row):?>
  #<?= h($row[1])?>,
  <?php endforeach;?>
  <?php else:?>
  #000,
  <?php endif;?>
  #fff);">

  <main>
    <?php require('../viewall.php'); ?>
  </main>
  <script src="../../js/flash.js"></script>

  <?php require('../now.php'); ?>
  <script src="../../js/viewall.js"></script>
</body>
</html>
