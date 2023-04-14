<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$year = date("Y");
$month = date("m");

$day = date("d");
if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$source_file = "log/". $month ."/". $day . ".csv";
$fp = fopen($source_file, 'a+b');

$post = sizeof(file($source_file));

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$title = date("n") .'月'. $day .'日の気持ちを知る・表す';
$description = $post .'の色と記号';

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <script src="/js/index.js" async></script>

  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../css/all.css" />
  <link rel="stylesheet" href="../css/flash.css" />
  <style type="text/css">
  header {
    mix-blend-mode: difference;
  }

  #js-button,
  #contents a {
    filter: invert();
  }
  </style>
</head>
<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)) : ?>
  <?php foreach ($rows as $row) : ?>
  #<?= h($row[1]) ?>,
  <?php endforeach; ?>
  <?php else : ?>
  #000,
  <?php endif; ?>
  #fff);">

  <script src="/js/menu.js"></script>
  <header id="menu" hidden>
    <button id="js-button"><b></b></button>
    <nav id="contents">
      <a href="/" target="_parent">
        <p><b>creative-community.space</b></p>
        <u>Index</u>
      </a>
    </nav>
  </header>

  <main>
    <?php
    require('../php/viewall.php');
    ?>
  </main>
  <script src="../js/flash.js"></script>
  <script src="../js/viewall.js"></script>

  <form id="now" class="hidden" method="GET">
    <section>
      <button type="button" onclick="flashView()">
        <span><?php echo $month;?> 月 <?php echo $day;?> 日</span>
      </button>
      <button type="button" onclick="allView()">
        <span><?php echo $post;?> の色と記号</span>
      </button>
    </section>
    <section>
      <select id="select" name="day"></select>
      <button type="submit">View The Collection</button>
    </section>
  </form>
  <script src="../js/log.js"></script>
</body>
</html>
