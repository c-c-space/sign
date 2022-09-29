<?php

date_default_timezone_set('Asia/Tokyo');

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$today = date("Ymd");
$source_file =  $today . ".csv";

$fp = fopen($source_file, 'a+b');

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}

?>

<!DOCTYPE html>
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
    <link rel="stylesheet" href="background.css" />
    <link rel="stylesheet" href="all.css" />
    <link rel="stylesheet" href="flash.css" />
</head>

<body id="open">

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="flash.js"></script>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script src="now.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#all").load("all.php");
        })
    </script>
</body>

</html>