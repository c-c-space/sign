<?php
$month = "12";
$day = "01";

require('../function.php');
?>

<script type="text/javascript">
let thismonth = 12
const endDate = 31
</script>

<main>
  <?php require('../../php/viewall.php'); ?>
</main>
<script src="../../js/flash.js"></script>
<script src="../../js/viewall.js"></script>

<?php require('../now.php'); ?>
<script src="../../js/selectdate.js" async></script>
</body>
</html>
