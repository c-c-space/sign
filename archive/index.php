<?php

mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file = "../" . $today . ".csv";

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

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>令和__年__月 の 色と記号</title>

    <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>
    <script src="../flash/script.js"></script>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../index.css" />
    <link rel="stylesheet" href="../all/style.css" />
    <link rel="stylesheet" href="../background/style.css" />
    <link rel="stylesheet" href="../flash/style.css" />
    
    <style type="text/css">
    </style>
</head>

<body id="open">

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#flash">
            #<?php
            if(isset($_POST["today"])) {
                $today = $_POST["today"];
                echo $today;
            }
            ?>MONTH__
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a id="showTime" class="tab" href="#log">
            <?php
            echo sizeof(file($source_file));
            ?>
            Posts
        </a>
        <span class="check"><b>✔</b></span>
    </div>
</div>

<div id="background">
    <ul id="gradient">
        <li class="bg" style="background-image: linear-gradient(180deg,
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            #<?=h($row[1])?>,
            <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
            #fff);">
        </li>
    </ul>
</div>

<div id="flash" class="change">
        <ul id="random" class="flash">
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            <li>
                <span class="color" style="background:#<?=h($row[1])?>;">
                  <b class="symbol" style="color:#<?=h($row[1])?>;"><?=h($row[0])?></b>
                </span>
            </li>
            <?php endforeach; ?>
            <?php else: ?>
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

<div id="log" class="change">
    <div id="mod">
        <b id="ed">𝕹𝖊𝖜 𝕷𝖎𝖋𝖊 𝕮𝖔𝖑𝖑𝖊𝖈𝖙𝖎𝖔𝖓</b>
        <p id="today">
            <sup style="text-transform: uppercase;">
            #<?php
            if(isset($_POST["today"])) {
                $today = $_POST["today"];
                echo $today;
            }
            ?>MONTH__
            を表す
            <br/>
            <?php
            echo sizeof(file($source_file));
            ?>
            の 色と記号
            </sup>
        </p>

        <div id="credit">
            <b class="print">Colors and Symbols</b>
            <span class="print">This is The Collection of Colors and Symbols That Fits On Month ____.</span>
            <span class="print">令和__年__月 の 気持ちを知る・表す 色と記号</span>
        </div>
    </div>
    <ul id="log_items">
        <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
                <li>
                    <p>
                        <u style="background:#<?=h($row[1])?>;"><span><?=h($row[0])?></span></u>
                        <b class="post" style="color:#<?=h($row[1])?>; user-select:none; pointer-events:none; filter: invert();"><?=h($row[3])?></b>
                    </p>
                    <p class="post" style="user-select:none; pointer-events:none; text-transform: uppercase;">
                        <?=h($row[2])?>
                    </p>
                </li>
            <?php endforeach; ?>
            <?php else: ?>
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

<form id="date" action="" method="POST">
        <select name="today">
            <option value="">令和__年__月</option>
            <option value="01">1 日 (月)</option>
            <option value="02">2 日 (火)</option>
            <option value="03">3 日 (水)</option>
            <option value="04">4 日 (木)</option>
            <option value="05">5 日 (金)</option>
            <option value="06">6 日 (土)</option>
            <option value="07">7 日 (日)</option>
            <option value="08">8 日 (月)</option>
            <option value="09">9 日 (火)</option>
            <option value="10">10 日 (水)</option>
            <option value="11">11 日 (木)</option>
            <option value="12">12 日 (金)</option>
            <option value="13">13 日 (土)</option>
            <option value="14">14 日 (日)</option>
            <option value="15">15 日 (月)</option>
            <option value="16">16 日 (火)</option>
            <option value="17">17 日 (水)</option>
            <option value="18">18 日 (木)</option>
            <option value="19">19 日 (金)</option>
            <option value="20">20 日 (土)</option>
            <option value="21">21 日 (日)</option>
        </select>
        <input type="submit" name="submit" value="View The Collection"/>
    </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.change').hide();

        $('.tab').on('click', function() {
            $('.change').not($($(this).attr('href'))).hide();
            $($(this).attr('href')).fadeToggle(1000);
        });
    });

    $('a[href^="#"]').click(function() {
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        return false;
    });
</script>
</body>

</html>