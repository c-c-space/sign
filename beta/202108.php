<?php
$title = '令和三年八月';
$year = "2021";
$month = "08";

require('function.php');
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
    <?php
    require('viewall.php');
    ?>
  </main>
  <script src="../js/flash.js"></script>

  <form id="now" class="hidden" method="GET">
    <button type="button" onclick="flashView()">
      <span id="title"><?php echo $title;?></span>
    </button>
    <button type="button" id="allBtn" onclick="allView()">
      <span><?php echo $post;?> の色と記号</span>
    </button>
  </form>
  <script src="../js/viewall.js"></script>
</body>
</html>
