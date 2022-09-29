<?php

mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$day = date("d");
$year = date("Y");
$month = date("m");
$source_file = $year . "/" . $month . "/" . $day . ".csv";

$symbol = (string)filter_input(INPUT_POST, 'symbol');
$color = (string)filter_input(INPUT_POST, 'color');
$timestamp = date("j.M.y.D g:i:s A");

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($source_file, 'a+b');

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

// 変数の初期化
$page_flag = 0;

if (!empty($_POST['enter'])) {
  $page_flag = 1;
  session_start();
  $_SESSION['page'] = true;
} elseif (!empty($_POST['submit'])) {
  session_start();
  if (!empty($_SESSION['page']) && $_SESSION['page'] === true) {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
    rewind($fp);
    $page_flag = 2;
  } else {
    $page_flag = 0;
  }
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}
flock($fp, LOCK_UN);
?>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <title>自分の気持ちを知る・表す</title>
  <meta name="description" content="これは、35 の 記号 と 18 の 色 を使って 自分の気持ちを知る・表す コミュニケーションツール です。">

  <meta property="og:title" content="自分の気持ちを知る・表す" />
  <meta property="og:description" content="これは、35 の 記号 と 18 の 色 を使って 自分の気持ちを知る・表す コミュニケーションツール です。" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://creative-community.space/sign/" />
  <meta property="og:image" content="イメージファイルのURL（1200x630 以上、8MB 以下、縦横比 1.91:1 の画像を推奨）" />
  <meta property="og:locale" content="ja_JP" />
  <meta name="twitter:card" content="summary_large_image" />

  <link rel="icon" sizes="32x32" href="ファビコンのURL (ICO or PNG,GIF)">
  <link rel="icon" sizes="192x192" href="アンドロイド端末用WEBクリップアイコンのURL (PNG)">
  <link rel="apple-touch-icon" sizes="180x180" href="アップル端末用WEBクリップアイコンのURL (PNG)">

  <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
  <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
  <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
  <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>

  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="background/style.css" />
  <link rel="stylesheet" href="all/style.css" />
  <link rel="stylesheet" href="flash/style.css" />
  <link rel="stylesheet" href="submit/style.css" />
</head>

<body id="box">

  <main id="gradient">
    <section class="bg" style="background-image: linear-gradient(0deg,
        <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
        #<?= h($row[1]) ?>,
        <?php endforeach; ?>
        <?php else : ?>
        #000,
        <?php endif; ?>
        #fff);">
    </section>
  </main>

  <?php if ($page_flag === 1) : ?>
    <section id="sign">
      <form method="post">

        <div id="symbol">
          <p class="title">
            <b>Choose A Symbol That Suits on Now Feelings</b>
            <br />今の気持ちに合う記号を選んでください。
          </p>
          <ul>
            <li class="click">
              <input type="radio" name="symbol" value="⎮" id="a" required>
              <label for="a" class="label">⎮</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="／" id="b" required>
              <label for="b" class="label">／</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="-" id="c" required>
              <label for="c" class="label">-</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⧹" id="d" required>
              <label for="d" class="label">⧹</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∥" id="e" required>
              <label for="e" class="label">∥</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∧" id="f" required>
              <label for="f" class="label">∧</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="┐" id="g" required>
              <label for="g" class="label">┐</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∟" id="h" required>
              <label for="h" class="label">∟</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⟩" id="i" required>
              <label for="i" class="label">⟩</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∠" id="j" required>
              <label for="j" class="label">∠</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⁔" id="k" required>
              <label for="k" class="label">⁔</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="◡" id="l" required>
              <label for="l" class="label">◡</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="৲" id="m" required>
              <label for="m" class="label">৲</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="〜" id="n" required>
              <label for="n" class="label">〜</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⌇" id="0" required>
              <label for="0" class="label">⌇</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="°" id="p" required>
              <label for="p" class="label">°</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="・" id="q" required>
              <label for="q" class="label">・</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⦂" id="r" required>
              <label for="r" class="label">⦂</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="…" id="s" required>
              <label for="s" class="label">…</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⋰" id="t" required>
              <label for="t" class="label">⋰</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="❜" id="u" required>
              <label for="u" class="label">❜</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="❞" id="v" required>
              <label for="v" class="label">❞</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="“" id="w" required>
              <label for="w" class="label">“</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∝" id="x" required>
              <label for="x" class="label">∝</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⍥" id="y" required>
              <label for="y" class="label">⍥</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="∰" id="z" required>
              <label for="z" class="label">∰</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⟡" id="aa" required>
              <label for="aa" class="label">⟡</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="▱" id="ab" required>
              <label for="ab" class="label">▱</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="♯" id="ac" required>
              <label for="ac" class="label">♯</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="*" id="ad" required>
              <label for="ad" class="label">*</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⧘" id="ae" required>
              <label for="ae" class="label">⧘</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⌠" id="af" required>
              <label for="af" class="label">⌠</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⥾" id="ag" required>
              <label for="ag" class="label">⥾</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="¶" id="ah" required>
              <label for="ah" class="label">¶</label>
            </li>
            <li class="click">
              <input type="radio" name="symbol" value="⎷" id="ai" required>
              <label for="ai" class="label">⎷</label>
            </li>
          </ul>
        </div>

        <div id="color">
          <p class="title">
            <b>Choose A Color That Suits on Now Feelings</b>
            <br />今の気持ちに合う色を選んでください。
          </p>
          <ul>
            <li class="click">
              <input type="radio" name="color" value="ff0000" id="ff0000" required>
              <label for="ff0000" class="label" style="background:#ff0000;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="fffafa" id="fffafa" required>
              <label for="fffafa" class="label" style="background:#fffafa;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="f0ffff" id="f0ffff" required>
              <label for="f0ffff" class="label" style="background:#f0ffff;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="808080" id="808080" required>
              <label for="808080" class="label" style="background:#808080;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="b0c4de" id="b0c4de" required>
              <label for="b0c4de" class="label" style="background:#b0c4de;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="800000" id="800000" required>
              <label for="800000" class="label" style="background:#800000;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="0000cd" id="0000cd" required>
              <label for="0000cd" class="label" style="background:#0000cd;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="ff8c00" id="ff8c00" required>
              <label for="ff8c00" class="label" style="background:#ff8c00;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="483d8b" id="483d8b" required>
              <label for="483d8b" class="label" style="background:#483d8b;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="b8860b" id="b8860b" required>
              <label for="b8860b" class="label" style="background:#b8860b;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="ba55d3" id="ba55d3" required>
              <label for="ba55d3" class="label" style="background:#ba55d3;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="d2b48c" id="d2b48c" required>
              <label for="d2b48c" class="label" style="background:#d2b48c;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="ffb6c1" id="ffb6c1" required>
              <label for="ffb6c1" class="label" style="background:#ffb6c1;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="556b2f" id="556b2f" required>
              <label for="556b2f" class="label" style="background:#556b2f;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="ffdab9" id="ffdab9" required>
              <label for="ffdab9" class="label" style="background:#ffdab9;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="008080" id="008080" required>
              <label for="008080" class="label" style="background:#008080;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="fff000" id="fff000" required>
              <label for="fff000" class="label" style="background:#fff000;"></label>
            </li>
            <li class="click">
              <input type="radio" name="color" value="90ee90" id="90ee90" required>
              <label for="90ee90" class="label" style="background:#90ee90;"></label>
            </li>
          </ul>
        </div>

        <div id="post">
          <input type="submit" name="submit" value="Submit">
          <input type="button" value="Back" onClick="history.back(); return false;">
        </div>
      </form>
    </section>

  <?php elseif ($page_flag === 2) : ?>

    <section id="fin" method="post"></section>


  <?php else : ?>

    <form id="enter" method="post">
      <input type="submit" name="enter" class="nlc tab" value="自分の気持ちを知る・表す">
    </form>

    <div id="menu" class="nlc">
      <div>
        <a class="tab" href="#all">
          <?php
          date_default_timezone_set('Asia/Tokyo');
          print(date('Y 年 n 月 j 日') . " ($week_name[$w])")
          ?>
        </a>
        <span class="check"><b>✔</b></span>
      </div>
      <div>
        <a id="showTime" class="tab" href="#flash"></a>
        <span class="check"><b>✔</b></span>
      </div>
    </div>

    <div id="all" class="change">
      <div id="log">
        <ul id="log_items">
          <?php if (!empty($rows)) : ?>
            <?php foreach ($rows as $row) : ?>
              <li>
                <p>
                  <u style="background:#<?= h($row[1]) ?>;"><span><?= h($row[0]) ?></span></u>
                  <b class="post" style="color:#<?= h($row[1]) ?>; user-select:none; pointer-events:none; filter: invert();"><?= h($row[3]) ?></b>
                </p>
                <p class="post" style="user-select:none; pointer-events:none; text-transform: uppercase;">
                  <?= h($row[2]) ?>
                </p>
              </li>
            <?php endforeach; ?>
          <?php else : ?>
            <li>
              <p>
                <u style="background:#000;"><span style="color:#fff;">?</span></u>
                <b class="post" style="color:#000; user-select:none; pointer-events:none;">Under Construction</b>
              </p>
              <p class="post" style="user-select:none; pointer-events:none; text-transform: uppercase;">IP <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i></p>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div id="flash" class="change">
      <ul id="random" class="flash">
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li>
              <span class="color" style="background:#<?= h($row[1]) ?>;">
                <b class="symbol" style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></b>
              </span>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li>
            <span class="color" style="background:#fff;">
              <b class="symbol" style="color:#fff;">?</b>
            </span>
          </li>
        <?php endif; ?>
      </ul>
      <section id="speed">
        <input type="range" id="flash_speed" value="" min="0" max="5000">
      </section>
    </div>

  <?php endif; ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="index.js"></script>
  <script src="click.js"></script>
  <script src="flash/script.js"></script>
  <script src="now.js"></script>
</body>

</html>