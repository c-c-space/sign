<?php
date_default_timezone_set('Asia/Tokyo');

$month = "10";

if (isset($_GET["day"])) {
  $day = $_GET["day"];
} else {
  $day = "01";
}

$source_file = $day . ".csv";

require('../head.php');
?>

<script type="text/javascript">
  menuJSON('../../index.json')

  let thismonth = 10
  const endDate = 31
</script>
</head>

<?php require('../body.php'); ?>
<script src="../../js/selectDate.js"></script>
</body>

</html>