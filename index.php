<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$today = date("Y/m/d");
$source_file =  $today . ".csv";

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
    <title>自分の気持ちを知る・表す</title>

    <script src="https://creative-community.space/coding/js/tone/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/jquery-ui.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/Tone.min.js"></script>
    <script src="https://creative-community.space/coding/js/tone/StartAudioContext.js"></script>
    <script src="flash.js"></script>

    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="all.css" />
    <link rel="stylesheet" href="flash.css" />
    
    <style type="text/css">
        
        #btn {
            position: fixed;
            top: 2.5vw;
            right: 2.5vw;
            z-index: 100;
            color: #000;
            border-radius: 50%;
            text-decoration: none;
            transition: .5s all;
            width: 3vw;
            height: 3vw;
        }
        
        #btn:hover {
            cursor: pointer;
            color: #fff;
            transition: 1s all;
        }
        
        #btn b {
            position: absolute;
            padding: 0;
            margin: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            font-weight: 500;
            letter-spacing: .1vw;
            font-family: "SimSong", "MS Mincho", serif;
            font-size: 2.5vw;
        }
        
        #background,
        #flash,
        #all,
        #submit {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #background {
            z-index: -1;
        }
        
        #submit iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        #submit,
        .open #menu {
            display: none;
        }

        .open #submit {
            z-index: 99;
            background-color: #fff;
            display: block;
        }
        
        @media screen and (max-width: 550px) {
            #btn {
                width: 2rem;
                height: 2rem;
            }
            #btn b {
                letter-spacing: .1rem;
                font-size: 1.5rem;
            }
        }
        
        @media print {
            #menu,
            #btn,
            #index {
                display: none;
            }
        }
    </style>
</head>

<body id="open">
<a id="btn"><b>⎷</b></a>

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#sign">
            <?php
            date_default_timezone_set('Asia/Tokyo');
            print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
            ?>
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a id="showTime" class="tab" href="#flash"></a><span class="check"><b>✔</b></span>
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
    <div id="mod">
            <b id="ed">𝕹𝖊𝖜 𝕷𝖎𝖋𝖊 𝕮𝖔𝖑𝖑𝖊𝖈𝖙𝖎𝖔𝖓</b>
            <p id="today">
                <sup id="no" style="text-transform: uppercase;">
                    #
                    <?php
                    $mod = filemtime($source_file);
                    date_default_timezone_set('Asia/Tokyo');
                    print "".date("jMyD",$mod);
                    ?>
            </sup>
                <sup id="time" style="text-transform: uppercase;">
                    Last Modified 
                    <?php
                    $mod = filemtime($source_file);
                    date_default_timezone_set('Asia/Tokyo');
                    print "".date("g:i:s A T",$mod);
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
<div id="submit"><iframe src="submit/"></iframe></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
        </script>
<script type="text/javascript">
    let btn = document.querySelector('#btn');
    let box = document.querySelector('#open');

    let btnToggleclass = function(el) {
        el.classList.toggle('open');
    }

    btn.addEventListener('click', function() {
        btnToggleclass(box);
    }, false);

    function set2(num) {
        let ret;
        if (num < 10) {
            ret = "0" + num;
        } else {
            ret = num;
        }
        return ret;
    }
    
    function showClock() {
        const nowTime = new Date();
        const nowHour = set2(nowTime.getHours());
        const nowMin = set2(nowTime.getMinutes());
        const nowSec = set2(nowTime.getSeconds());
        const msg = "" + nowHour + ":" + nowMin + ":" + nowSec + "";
        document.getElementById("showTime").innerHTML = msg;
    }
    setInterval('showClock()', 1000);

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