<?php
$title = "一月"
$month = "01";
$day = "01";

require('../function.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
</head>

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
