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

$fp = fopen($source_file, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
    rewind($fp);
}

// 変数の初期化
$page_flag = 0;

if (!empty($_POST['yourinfo'])) {
  $page_flag = 1;
  session_start();
  $_SESSION['page'] = true;
} elseif (!empty($_POST['enter'])) {
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
    <link rel="stylesheet" href="log/style.css" />
    <style>
    </style>
</head>

<body id="box">

    <?php if ($page_flag === 1) : ?>
    <section id="info">
        <form method="post">
            <input type="submit" name="enter" value="Enter">
            <input type="button" value="Back" onClick="history.back(); return false;">
        </form>
    </section>

    <?php elseif ($page_flag === 2) : ?>
    <ul id="log">
    </ul>

    <?php else : ?>

    <form id="enter" method="post">
        <select id="voice-select"></select>
        <input type="button" id="speak-btn" value="Play">
        <input type="button" id="cancel-btn" value="Stop">
        <input type="hidden" id="pause-btn" value="Pause">
        <input type="hidden" id="resume-btn" value="Resume">
        <hr />
        <div id="greeting"></div>

        <p class="submit">
            <input type="submit" name="yourinfo" value="Your Info">
        </p>
    </form>

    <?php endif; ?>

</body>

</html>