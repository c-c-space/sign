<?php
$month = "11";
$day = "01";

require('../function.php');
?>

<script type="text/javascript">
let thismonth = 1
const endDate = 30
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
