<?php
date_default_timezone_set('Asia/Tokyo');

$month = date("m");
$day = date("d");

if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$source_file = $month . "/" . $day . ".csv";

require('head.php');
?>

<script src="/js/login.js"></script>
<script src="readyState.js"></script>
<script type="text/javascript">
  menuJSON('../index.json')
</script>

<link rel="stylesheet" href="../css/about.css" />
<link rel="stylesheet" href="../css/submit.css" />
</head>

<?php require('body.php'); ?>

<form id="submit" method="post" hidden></form>
<script src="../js/submit.js"></script>
</body>

</html>