<?php
date_default_timezone_set('Asia/Tokyo');

$month = "04";

if (isset($_GET["day"])) {
  $day = $_GET["day"];
  $source_file = $day . ".csv";
} else {
  $day = "1 - 30";
  $source_file = "01.csv";
  $source_file = "02.csv";
  $source_file = "03.csv";
  $source_file = "04.csv";
  $source_file = "05.csv";
  $source_file = "06.csv";
  $source_file = "07.csv";
  $source_file = "08.csv";
  $source_file = "09.csv";
  $source_file = "10.csv";
  $source_file = "11.csv";
  $source_file = "12.csv";
  $source_file = "13.csv";
  $source_file = "14.csv";
  $source_file = "15.csv";
  $source_file = "16.csv";
  $source_file = "17.csv";
  $source_file = "18.csv";
  $source_file = "19.csv";
  $source_file = "20.csv";
  $source_file = "21.csv";
  $source_file = "22.csv";
  $source_file = "23.csv";
  $source_file = "24.csv";
  $source_file = "25.csv";
  $source_file = "26.csv";
  $source_file = "27.csv";
  $source_file = "28.csv";
  $source_file = "29.csv";
  $source_file = "30.csv";
}

require('../head.php');
?>

<script type="text/javascript">
  menuJSON('../../index.json')

  let thismonth = 4
  const endDate = 30
</script>
</head>

<?php require('../body.php'); ?>
<script src="../../js/selectDate.js"></script>
</body>

</html>