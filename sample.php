<?php

mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file =  $today . ".csv";

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

  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="background.css" />
  <link rel="stylesheet" href="all.css" />
  <link rel="stylesheet" href="flash.css" />
  <link rel="stylesheet" href="submit/style.css" />
  <style>
    #enter {
      box-sizing: border-box;
      position: relative;
      z-index: 5;
      width: 100%;
      padding: 2.5%;
    }

    #enter #greeting {
      padding: 2.5% 0;
    }

    #enter input[type="submit"] {
      position: absolute;
      top: 0;
      right: 0;
      color: #000;
      font-size: 1rem;
      border: none;
      margin: 2.5%;
      cursor: pointer;
      background: transparent;
      display: inline-block;
      text-decoration: none;
      font-weight: 500;
      -ms-writing-mode: tb-rl;
      writing-mode: vertical-rl;
    }

    #enter #voice-select,
    #enter input[type="button"] {
      color: #000;
      font-size: 1rem;
      padding: 0.5rem 1rem;
      margin: 0.25rem 0.5rem 0.25rem 0;
      border: 1px solid;
      border-radius: 2rem;
      background: transparent;
      cursor: pointer;
      display: inline-block;
      font-weight: 500;
      text-decoration: none;
    }
  </style>
</head>

<body id="box">

  <main id="gradient">
    <section class="bg" style="background-image: linear-gradient(180deg,
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
          <p class="title"><b>Choose A Symbol That Suits on Now Feelings</b><br /> 今の気持ちに合う記号を選んでください。
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
          <p class="title"><b>Choose A Color That Suits on Now Feelings</b><br /> 今の気持ちに合う色を選んでください。
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
          <br/>
          <input type="button" value="Back" onClick="history.back(); return false;">
        </div>
      </form>
    </section>

  <?php elseif ($page_flag === 2) : ?>
    <ul id="log">
    </ul>

  <?php else : ?>

    <form id="enter" method="post">
      <input type="submit" name="enter" value="自分の気持ちを知る・表す">
      <div id="greeting">Hi</div>
      <select id="voice-select"></select>
      <input type="button" id="speak-btn" value="Play">
      <input type="button" id="cancel-btn" value="Stop">
      <input type="hidden" id="pause-btn" value="Pause">
      <input type="hidden" id="resume-btn" value="Resume">
    </form>
    <script src="/speech.js"></script>

  <?php endif; ?>

</body>

</html>