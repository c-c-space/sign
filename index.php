<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$month = date("Ym");
$day = date("d");
$source_file = "log/". $month . $day . ".csv";

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($source_file, 'a+b');

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}
flock($fp, LOCK_UN);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <script src="../js/index.js" async></script>
  <script src="js/readyState.js"></script>

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="css/all.css" />
  <link rel="stylesheet" href="css/flash.css" />
  <link rel="stylesheet" href="css/submit.css" />
  <style>
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
    <section id="all">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li>
              <p>
                <u style="background:#<?= h($row[1]) ?>;">
                  <span><?= h($row[0]) ?></span>
                </u>
                <b style="color:#<?= h($row[1]) ?>;"><?= h($row[3]) ?></b>
              </p>
              <p><?= h($row[2]) ?></p>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li>
            <p>
              <u style="background:#000;">
                <span style="color:#fff;">?</span>
              </u>
              <b>Nothing Here</b>
            </p>
            <p>
              IP
              <i><?php echo $ip ?></i>
            </p>
          </li>
        <?php endif; ?>
      </ul>
    </section>

    <section id="flash">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li style="background:#<?= h($row[1]) ?>;">
              <b style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></b>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li style="background:#aaa;">
            <b style="color:#aaa;">✔︎</b>
          </li>
        <?php endif; ?>
      </ul>
      <section id="speed">
        <input id="flash_speed" type="range" value="" min="500" max="5000">
      </section>
      <script src="js/flash.js" async></script>
    </section>

    <nav id="now">
      <button type="button" id="allBtn" onclick="allView()">
        <span>
          <?php
          date_default_timezone_set('Asia/Tokyo');
          print(date('Y 年 n 月 j 日') . " ($week_name[$w])")
          ?>
        </span>
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
  <main id="submit" hidden></main>

</body>
</html>
