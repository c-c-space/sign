<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$day = date("d");
if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$year = date("Y");
$month = date("m");
$source_file = $year . $month . $day . ".csv";

$fp = fopen($source_file, 'r');

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
  <link rel="stylesheet" href="../css/all.css" />
  <link rel="stylesheet" href="../css/flash.css" />
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
  <form id="now" method="GET">
    <select id="select" name="day"></select>
    <button type="submit" name="submit">決定</button>
    <script src="../js/log.js"></script>
  </form>

  <main>
    <section id="all">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li>
              <p><?= h($row[2]) ?></p>
              <p>
                <u style="background:#<?= h($row[1]) ?>;">
                  <span><?= h($row[0]) ?></span>
                </u>
                <b style="color:#<?= h($row[1]) ?>;"><?= h($row[3]) ?></b>
              </p>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li>
            <p>IP <i><?php echo $ip ?></i></p>
            <p>
              <u style="background:#000;">
                <span style="color:#fff;">?</span>
              </u>
              <b>Nothing Here</b>
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
      <script src="../js/flash.js" async></script>
    </section>

    <nav id="log">
      <button type="button" onclick="flashView()">
        <span>Flash</span>
      </button>
      <button type="button" id="allBtn" onclick="allView()">
        <span>View All</span>
      </button>
    </nav>

    <script type="text/javascript">
    function allView() {
      let all = document.querySelector('#all');
      let flash = document.querySelector('#flash');
      if (all.style.opacity == 1) {
        all.style.opacity = 0;
        flash.style.opacity = 0;
      } else {
        all.style.opacity = 1;
        flash.style.opacity = 0;
      }
    }

    function flashView() {
      let flash = document.querySelector('#flash');
      let all = document.querySelector('#all');
      if (flash.style.opacity == 1) {
        flash.style.opacity = 0;
        all.style.opacity = 0;
      } else {
        flash.style.opacity = 1;
        all.style.opacity = 0;
      }
    }
    </script>
  </main>
</body>
</html>
