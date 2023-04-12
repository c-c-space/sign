<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$month = "202104";
if (isset($_GET["month"])) {
  $month = $_GET["month"];
}

$source_file = $month . ".csv";
$fp = fopen($source_file, 'a+b');

$post = sizeof(file($source_file));

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../css/viewall.css" />
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
      <a href="/sign/" target="_parent">
        <i>Colors and Symbols that Suits on Today</i>
        <p>今日の気持ちを知る・表す</p>
      </a>
    </nav>
  </header>

  <form id="now" class="hidden" method="GET">
    <section>
      <button type="button" onclick="flashView()">
        <span><?php echo $month;?></span>
      </button>
      <button type="button" id="allBtn" onclick="allView()">
        <span><?php echo $post;?> の色と記号</span>
      </button>
    </section>
    <section>
      <select id="month" name="month"></select>
      <button type="submit">View The Collection</button>
    </section>
    <script src="month.js"></script>
  </form>

  <main>
    <section id="all">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li style="background:#<?= h($row[1]) ?>;">
              <span style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></span>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li style="background:#000;">
            <span style="color:#fff;">?</span>
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
            <b style="color:#aaa;">?</b>
          </li>
        <?php endif; ?>
      </ul>
      <section id="speed">
        <input id="flash_speed" type="range" value="" min="500" max="5000">
      </section>
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="../js/flash.js" async></script>
    </section>

    <nav id="log"></nav>

    <script type="text/javascript">
    function allView() {
      let all = document.querySelector('#all');
      let flash = document.querySelector('#flash');
      if (all.style.opacity == 1) {
        all.style.opacity = 0;
        flash.style.opacity = 0;
        all.style.zIndex = 0;
        flash.style.zIndex = 0;
      } else {
        all.style.opacity = 1;
        flash.style.opacity = 0;
        all.style.zIndex = 1;
        flash.style.zIndex = 0;
      }
    }

    function flashView() {
      let flash = document.querySelector('#flash');
      let all = document.querySelector('#all');
      if (flash.style.opacity == 1) {
        flash.style.opacity = 0;
        all.style.opacity = 0;
        flash.style.zIndex = 0;
        all.style.zIndex = 0;
      } else {
        flash.style.opacity = 1;
        all.style.opacity = 0;
        flash.style.zIndex = 1;
        all.style.zIndex = 0;
      }
    }
    </script>
  </main>
</body>
</html>
