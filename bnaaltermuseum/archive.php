<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

if(isset($_POST["today"])) {
    $today = $_POST["today"];
}

$source_file = $today . ".csv";

$fp = fopen($source_file, 'r');

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</title>

    <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>
    <script src="flash.js"></script>

    <link rel="stylesheet" href="https://creative-community.space/sign/index.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/all.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/background.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/flash.css" />
    
    <style type="text/css">
        #background,
        #flash,
        #all {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #background {
            z-index: -1;
        }
        
        @media print {
            #menu,
            #index {
                display: none;
            }
        }
    </style>
</head>

<body id="open">

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#all">
            #
            <?php
            if(isset($_POST["today"])) {
                $today = $_POST["today"];
                echo $today;
            }
            ?>
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a class="tab" href="#flash">
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
<div id="all" class="change">
        <div id="log">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="flash.js"></script>
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