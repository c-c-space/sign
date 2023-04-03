<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

$month = date("Ym");
$day = date("d");
$source_file = "log/". $month . $day . ".csv";

$forwardedFor = $_SERVER["REMOTE_ADDR"];

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
                <b style="color:#<?= h($row[1]) ?>;"><?= h($row[2]) ?></b>
              </p>
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

  <form id="submit" method="post" hidden>
    <fieldset id="symbol">
      <p>
        <b>Choose A Symbol That Suits on Now Feelings</b>
        <br />今の気持ちに合う記号を選んでください。
      </p>
      <ul>
        <li>
          <input type="radio" name="symbol" value="⎮" id="a" required>
          <label for="a" class="label">⎮</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="／" id="b" required>
          <label for="b" class="label">／</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="-" id="c" required>
          <label for="c" class="label">-</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⧹" id="d" required>
          <label for="d" class="label">⧹</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∥" id="e" required>
          <label for="e" class="label">∥</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∧" id="f" required>
          <label for="f" class="label">∧</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="┐" id="g" required>
          <label for="g" class="label">┐</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∟" id="h" required>
          <label for="h" class="label">∟</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⟩" id="i" required>
          <label for="i" class="label">⟩</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∠" id="j" required>
          <label for="j" class="label">∠</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⁔" id="k" required>
          <label for="k" class="label">⁔</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="◡" id="l" required>
          <label for="l" class="label">◡</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="৲" id="m" required>
          <label for="m" class="label">৲</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="〜" id="n" required>
          <label for="n" class="label">〜</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⌇" id="0" required>
          <label for="0" class="label">⌇</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="°" id="p" required>
          <label for="p" class="label">°</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="・" id="q" required>
          <label for="q" class="label">・</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⦂" id="r" required>
          <label for="r" class="label">⦂</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="…" id="s" required>
          <label for="s" class="label">…</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⋰" id="t" required>
          <label for="t" class="label">⋰</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="❜" id="u" required>
          <label for="u" class="label">❜</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="❞" id="v" required>
          <label for="v" class="label">❞</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="“" id="w" required>
          <label for="w" class="label">“</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∝" id="x" required>
          <label for="x" class="label">∝</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⍥" id="y" required>
          <label for="y" class="label">⍥</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="∰" id="z" required>
          <label for="z" class="label">∰</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⟡" id="aa" required>
          <label for="aa" class="label">⟡</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="▱" id="ab" required>
          <label for="ab" class="label">▱</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="♯" id="ac" required>
          <label for="ac" class="label">♯</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="*" id="ad" required>
          <label for="ad" class="label">*</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⧘" id="ae" required>
          <label for="ae" class="label">⧘</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⌠" id="af" required>
          <label for="af" class="label">⌠</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⥾" id="ag" required>
          <label for="ag" class="label">⥾</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="¶" id="ah" required>
          <label for="ah" class="label">¶</label>
        </li>
        <li>
          <input type="radio" name="symbol" value="⎷" id="ai" required>
          <label for="ai" class="label">⎷</label>
        </li>
      </ul>
    </fieldset>

    <fieldset id="color">
      <p>
        <b>Choose A Color That Suits on Now Feelings</b>
        <br />今の気持ちに合う色を選んでください。
      </p>
      <ul>
        <li>
          <input type="radio" name="color" value="ff0000" id="ff0000" required>
          <label for="ff0000" class="label" style="background:#ff0000;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="fffafa" id="fffafa" required>
          <label for="fffafa" class="label" style="background:#fffafa;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="f0ffff" id="f0ffff" required>
          <label for="f0ffff" class="label" style="background:#f0ffff;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="808080" id="808080" required>
          <label for="808080" class="label" style="background:#808080;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="b0c4de" id="b0c4de" required>
          <label for="b0c4de" class="label" style="background:#b0c4de;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="800000" id="800000" required>
          <label for="800000" class="label" style="background:#800000;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="0000cd" id="0000cd" required>
          <label for="0000cd" class="label" style="background:#0000cd;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="ff8c00" id="ff8c00" required>
          <label for="ff8c00" class="label" style="background:#ff8c00;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="483d8b" id="483d8b" required>
          <label for="483d8b" class="label" style="background:#483d8b;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="b8860b" id="b8860b" required>
          <label for="b8860b" class="label" style="background:#b8860b;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="ba55d3" id="ba55d3" required>
          <label for="ba55d3" class="label" style="background:#ba55d3;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="d2b48c" id="d2b48c" required>
          <label for="d2b48c" class="label" style="background:#d2b48c;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="ffb6c1" id="ffb6c1" required>
          <label for="ffb6c1" class="label" style="background:#ffb6c1;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="556b2f" id="556b2f" required>
          <label for="556b2f" class="label" style="background:#556b2f;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="ffdab9" id="ffdab9" required>
          <label for="ffdab9" class="label" style="background:#ffdab9;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="008080" id="008080" required>
          <label for="008080" class="label" style="background:#008080;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="fff000" id="fff000" required>
          <label for="fff000" class="label" style="background:#fff000;"></label>
        </li>
        <li>
          <input type="radio" name="color" value="90ee90" id="90ee90" required>
          <label for="90ee90" class="label" style="background:#90ee90;"></label>
        </li>
      </ul>
    </fieldset>

    <section id="post">
      <input type="submit" id="submitBtn" value="Submit">
      <input type="button" id="backBtn" value="Back" onClick="changeHidden()">
    </section>
  </form>

  <script src="js/submit.js"></script>
</body>
</html>
