<?php

date_default_timezone_set('Asia/Tokyo');

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$day = date("d");
if (isset($_GET["day"])) {
    $day = $_GET["day"];
}

$month = date("Ym");
$source_file = "../" . $month . $day . ".csv";

$fp = fopen($source_file, 'r');
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
    <script src="../flash/script.js"></script>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../index.css" />
    <link rel="stylesheet" href="../all/style.css" />
    <link rel="stylesheet" href="../background/style.css" />
    <link rel="stylesheet" href="../flash/style.css" />

    <style type="text/css">
    </style>
</head>

<body id="box" style="background-image: linear-gradient(0deg,
<?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
        #<?= h($row[1]) ?>,
        <?php endforeach; ?>
        <?php else : ?>
        #000,
        <?php endif; ?>
    #fff);">

    <form id="collection" method="GET">
        <select id="date" name="day"></select>
        <input type="submit" name="submit" value="View The Collection" />
        <script src="script.js"></script>
    </form>

    <div id="index" class="nlc">
        <div>
            <a class="tab" href="#flash">
                <?php
                print "#" . $day;
                print(date('My'))
                ?>
            </a>
            <span class="check"><b>✔</b></span>
        </div>
        <div>
            <a class="tab" href="#all">
                <?php
                echo sizeof(file($source_file));
                ?>
                Posts
            </a>
            <span class="check"><b>✔</b></span>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script src="../click.js"></script>
    <script src="../flash/script.js"></script>
</body>

</html>