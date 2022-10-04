<?php

mb_language("ja");
mb_internal_encoding("UTF-8");
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
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>今日の気持ちを知る・表す</title>
    <meta name="description" content="これは、18 の 色 と 35 の 記号 を使って 自分の気持ちを知る・表す オンライン・コミュニケーションツール です。">

    <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../index.css" />
    <link rel="stylesheet" href="../all/style.css" />
    <link rel="stylesheet" href="../background/style.css" />
    <link rel="stylesheet" href="../flash/style.css" />
    <style>
        .Etiquette {
            font-family: "Etiquette";
            font-size: 200%;
            filter: invert();
            margin-bottom: 0.5rem;
        }

        @font-face {
            font-family: "Etiquette";
            src: url("https://creative-community.space/coding/fontbook/family/Etiquette-2OGXW.ttf");
        }
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
        <button type="submit" name="submit">View The Collection</button>
        <script src="script.js"></script>
    </form>

    <div id="index" class="nlc">
        <div>
            <a class="tab" href="#all">
                <?php
                echo sizeof(file($source_file));
                ?>
                Posts
            </a>
            <span class="check"><b>✔</b></span>
        </div>
        <a class="Etiquette" href="/sign/" target="_parent">SIGN</a>
        <div>
            <a class="tab" href="#flash">Flash</a>
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
                        <b class="symbol" style="color:#fff;"></b>
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
                                <u style="background:#<?= h($row[1]) ?>;">
                                    <span><?= h($row[0]) ?></span>
                                </u>
                                <b style="color:#<?= h($row[1]) ?>;"><?= h($row[3]) ?></b>
                            </p>
                            <p class="date"><?= h($row[2]) ?></p>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>
                        <a href="/sign/">
                            <p>
                                <u style="background:#000;">
                                    <span style="color:#fff;">?</span>
                                </u>
                                <b>Nothing Here</b>
                            </p>
                            <p class="date">IP
                                <i><?php echo $_SERVER['REMOTE_ADDR']; ?></i>
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script src="../flash/script.js"></script>
    <script src="../submit/script.js"></script>
</body>

</html>