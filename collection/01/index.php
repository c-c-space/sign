<?php
date_default_timezone_set('Asia/Tokyo');

$month = "01";

if (isset($_GET["day"])) {
  $day = $_GET["day"];
  $source_file = $day . ".csv";
} else {
  $day = "1 ~ 31";
  $source_file = "01.csv";
  $source_file = "02.csv";
}

require('../head.php');
?>

<script type="text/javascript">
  menuJSON('../../index.json')

  let thismonth = 1
  const endDate = 31
</script>
</head>

<?php require('../body.php'); ?>
<script src="../../js/selectDate.js"></script>
</body>

</html>