<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$year = date("Y");
$month = date("m");

$day = date("d");

$source_file = "collection/". $month ."/". $day . ".csv";
$fp = fopen($source_file, 'a+b');

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

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
  <script src="readyState.js"></script>

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="css/about.css" />
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="css/flash.css" />
  <link rel="stylesheet" href="css/submit.css" />
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
  <?php if (!empty($rows)):?>
  <?php foreach ($rows as $row):?>
  #<?= h($row[1])?>,
  <?php endforeach;?>
  <?php else:?>
  #aaa,
  <?php endif;?>
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
    <?php require('php/viewall.php'); ?>
    <nav id="now">
      <button type="button" id="allBtn" onclick="allView()">
        <span><?php print(date('n 月 j 日') . " ($week_name[$w])") ?></span>
      </button>
      <button type="button" onclick="flashView()">
        <time id="showTime"></time>
      </button>
    </nav>
    <script type="text/javascript">
    function set10(num) {
      let ret;
      if (num < 10) { ret = "0" + num; }
      else { ret = num; }
      return ret;
    }

    function nowOn() {
      const nowTime = new Date();
      const nowHour = set10(nowTime.getHours());
      const nowMin = set10(nowTime.getMinutes());
      const nowSec = set10(nowTime.getSeconds());
      const showTime = nowHour + ":" + nowMin + ":" + nowSec;
      document.querySelector("#showTime").textContent = showTime;
    }

    setInterval('nowOn()', 1000);
    </script>
  </main>
  <script src="js/flash.js"></script>
  <script src="js/viewall.js"></script>

  <form id="submit" class="hidden" method="post" hidden></form>
  <script src="js/submit.js"></script>
</body>
</html>
