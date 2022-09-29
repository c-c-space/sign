<?php

date_default_timezone_set('Asia/Tokyo');

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file =  "../" . $today . ".csv";

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>自分の気持ちを知る・表す</title>
    <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>
    <link rel="stylesheet" href="flash.css" />
</head>

<body>
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
</body>

</html>