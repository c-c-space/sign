<?php

date_default_timezone_set('Asia/Tokyo');

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$day = date("d");
$year = date("Y");
$month = date("m");
$source_file = "../" . $year . "/" . $month . "/" . $day . ".csv";

$fp = fopen($source_file, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
    rewind($fp);
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
    <meta name="format-detection" content="telephone=no">
    <title>自分の気持ちを知る・表す</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div id="mod">
        <b id="ed">自分の気持ちを知る・表す</b>
        <p id="today">
            <sup id="no" style="text-transform: uppercase;">
                <?php
                $mod = filemtime($source_file);
                date_default_timezone_set('Asia/Tokyo');
                print "#" . date("jMyD", $mod);
                ?>
            </sup>
            <sup id="time" style="text-transform: uppercase;">
                <?php
                $mod = filemtime($source_file);
                date_default_timezone_set('Asia/Tokyo');
                print "Last Modified " . date("g:i:s A T", $mod);
                ?>
            </sup>
            <sup id="post" style="text-transform: uppercase;">
                <?php
                echo sizeof(file($source_file));
                ?>
                Posts
            </sup>
        </p>
        <p id="credit"><img src="qr.png" width="100%"></p>
    </div>

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
</body>

</html>