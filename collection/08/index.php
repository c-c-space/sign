<?php
date_default_timezone_set('Asia/Tokyo');

$month = "08";
$day = "01";

if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$source_file = $day . ".csv";

require('../head.php');
?>

<script type="text/javascript">
  menuJSON('../../index.json')

  let thismonth = 8
  const endDate = 31
</script>
</head>

<?php require('../body.php'); ?>
<script src="../../js/selectdate.js"></script>
</body>

</html>