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
    <title>𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="https://creative-community.space/sign/index.css" />
    <style>
        body,
        #sign {
            padding: 0;
            margin: 0;
        }
        
        #sign {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: -1;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            pointer-events: none;
            user-select: none;
        }
        
        #flash,
        #all {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        li {
            list-style: none;
        }
        
        #gradient {
            position: relative;
            top: 0;
            left: 0;
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column-reverse;
        }
        
        .bg {
            position: relative;
            top: 0;
            left: 0;
            display: block;
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100vh;
            background-size: 500% 500%;
            animation: gradient 50s ease infinite;
        }

        #date {
            position:fixed;
            top: 0;
            margin: 1.25%;
            width: 97.5%;
        }
        
        #date select {
            font-size: 1rem;
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
            width:70%;
            padding: 1.25%;
            margin: 1.25%;
            display:block;
            float:left;

        }
        
        #date input[type="submit"] {
            font-size: 1rem;
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
            width:20%;
            padding: 1.25%;
            margin: 1.25%;
            display:block;
            float:right;
        }
        
        @keyframes gradient {
            0% {
                background-position: 100% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 100% 0%;
            }
        }
        
        @media print {
            .bg {
                background-size: 100% 100%;
                animation: gradient none;
            }

            #date {
                display: none;
            }
        }
    </style>
</head>

<body>

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
        <a id="showTime" class="tab" href="#flash">
            <?php
            echo sizeof(file($source_file));
            ?>
            Posts
        </a>
        <span class="check"><b>✔</b></span>
    </div>
</div>

    <div id="sign">
    <ul id="gradient">
        <li class="bg" style="background-image: linear-gradient(180deg,
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            #<?=h($row[1])?>,
            <?php endforeach; ?>
            <?php else: ?>
            #000,
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

    <form id="date" action="" method="POST">
        <select name="today">
            <option value="">令和四年版　夏の自由研究</option>
            <option value="20220723">2022 年 7 月 23 日 (土)</option>
            <option value="20220724">2022 年 7 月 24 日 (日)</option>
            <option value="20220725">2022 年 7 月 25 日 (月)</option>
            <option value="20220726">2022 年 7 月 26 日 (火)</option>
            <option value="20220727">2022 年 7 月 27 日 (水)</option>
            <option value="20220728">2022 年 7 月 28 日 (木)</option>
            <option value="20220729">2022 年 7 月 29 日 (金)</option>
            <option value="20220730">2022 年 7 月 30 日 (土)</option>
            <option value="20220731">2022 年 7 月 31 日 (日)</option>
            <option value="20220801">2022 年 8 月 1 日 (月)</option>
            <option value="20220802">2022 年 8 月 2 日 (火)</option>
            <option value="20220803">2022 年 8 月 3 日 (水)</option>
            <option value="20220804">2022 年 8 月 4 日 (木)</option>
            <option value="20220805">2022 年 8 月 5 日 (金)</option>
            <option value="20220806">2022 年 8 月 6 日 (土)</option>
            <option value="20220807">2022 年 8 月 7 日 (日)</option>
            <option value="20220808">2022 年 8 月 8 日 (月)</option>
            <option value="20220809">2022 年 8 月 9 日 (火)</option>
            <option value="20220810">2022 年 8 月 10 日 (水)</option>
            <option value="20220811">2022 年 8 月 11 日 (木)</option>
            <option value="20220812">2022 年 8 月 12 日 (金)</option>
            <option value="20220813">2022 年 8 月 13 日 (土)</option>
            <option value="20220814">2022 年 8 月 14 日 (日)</option>
            <option value="20220815">2022 年 8 月 15 日 (月)</option>
            <option value="20220816">2022 年 8 月 16 日 (火)</option>
            <option value="20220817">2022 年 8 月 17 日 (水)</option>
            <option value="20220818">2022 年 8 月 18 日 (木)</option>
            <option value="20220819">2022 年 8 月 19 日 (金)</option>
            <option value="20220820">2022 年 8 月 20 日 (土)</option>
            <option value="20220821">2022 年 8 月 21 日 (日)</option>
        </select>
        <input type="submit" name="submit" value="決定"/>
    </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
