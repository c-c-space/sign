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
    <section id="info">
      <form method="post">
        <input type="submit" name="submit" value="Submit">
        <input type="button" value="Back" onClick="history.back(); return false;">
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