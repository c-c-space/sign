<?php
$month = "01";
$day = "01";

require('../function.php');
?>

<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)) : ?>
  <?php foreach ($rows as $row) : ?>
  #<?= h($row[1]) ?>,
  <?php endforeach; ?>
  <?php else : ?>
  #000,
  <?php endif; ?>
  #fff);">

  <script type="text/javascript">
  let thismonth = 1
  const endDate = 31
  </script>

  <main>
    <?php require('../../php/viewall.php'); ?>
  </main>
  <script src="../../js/flash.js"></script>
  <script src="../../js/viewall.js"></script>

  <?php require('../now.php'); ?>
  <script src="../selectdate.js" async></script>
</body>
</html>
