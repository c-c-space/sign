<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$today = date("Ymd");
$source_file =  $today . ".csv";

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
    <style type="text/css">
        .nlc {
            font-family: 'Times New Roman', serif;
            font-weight: 500;
            line-height: 200%;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
        }
        
        #menu {
            position: fixed;
            z-index: 100;
            bottom: 0;
            left: 0;
            width: 95%;
            padding: 0.25rem 2.5%;
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        #menu .tab {
            color: #000;
            text-decoration: none;
            transition: all 500ms ease;
        }
        
        #menu .tab:hover,
        #menu .check b {
            cursor: pointer;
            color: #fff;
            transition: all 500ms ease;
        }
        
        #menu .check {
            float: left;
            display: inline-block;
            width: 2.5rem;
            margin-right: 0rem;
            text-align: center;
        }
        
        #menu .check:before {
            content: '[';
            opacity: 1;
        }
        
        #menu .check:after {
            content: ']';
            opacity: 1;
        }
        
        #btn {
            position: fixed;
            top: 2.5vw;
            right: 4.5vw;
            z-index: 100;
            color: #fff;
            text-shadow: 0.25vw 0.25vw 0.25vw #000;
            text-decoration: none;
            transition: .5s all;
            width: 3vw;
            height: 3vw;
        }
        
        #btn:hover {
            cursor: pointer;
            color: #000;
            text-shadow: 0.25vw 0.25vw 0.25vw #fff;
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
        
        .check b {
            opacity: 0;
            transition: all 1000ms ease;
        }
        
        .tab:hover+.check b {
            opacity: 1;
            transition: all 1000ms ease;
        }
        
        #background,
        #flash,
        #sign,
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
        
        #background iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        #submit,
        .open #menu {
            display: none;
        }

        .open #submit {
            position: absolute;
            z-index: 99;
            width:100%;
            min-height: 100vh;
            background-color: rgba(255,255,255,0.75);
            display: block;
            overflow: auto;
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
<a id="btn"><b>Click Here</b></a>

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#flash">
            <?php
            date_default_timezone_set('Asia/Tokyo');
            print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
            ?>
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a id="showTime" class="tab" href="#sign"></a><span class="check"><b>✔</b></span>
    </div>
</div>

<div id="background"><iframe src="background.php"></iframe></div>
<div id="flash" class="change"></div>
<div id="sign" class="change"></div>
<div id="submit">
    <div id="about" class="none">
        <hr/>
        <br/>
        <p><u>この作品について</u></p>
        <p>2022.7.23 - 8.21 の 期間中に、BnA Alter Museume へ 宿泊する方のみに配布する QRコード から アクセスできる このウェブサイトに、本日宿泊する皆様の 気持ちを集めた インターネットアート作品 を 制作しています。
            <br/> ※ 作品は、日本時間 24:00 にリセットされ、期間中は 毎日異なる 新しい作品 が 閲覧できます。 </p>
        <p>ページ背景の グラデーションカラー は、投稿された 色 が 上から下へ と連なり生成された、本日の宿泊者の皆様の気持ちを集めた色 です。
            <br/> ※ グラデーションが流れる速度は、投稿数に比例し加速します。</p>
        <p>ページ下部の日付をクリックすると、投稿された 色と記号 を 一つずつランダム に点灯する フラッシュアニメーション が表示されます。
            <br/> ※ 記号の色は、投稿された色 の 反対色 で表示され、自分の気持ちの 反対 を知ることに作用します。
            <br/>（ページ上部のメーターを左右に操作すると、色と記号 が入れ替わる速度 が 変化します。）</p>
        <p>ページ下部の現在時刻をクリックすると、投稿された全ての色と記号の一覧が表示されます。
            <br/> ※ 投稿数に制限はありません。自分の気持ちを知りたいとき、表したいときに、このウェブサイトへ 色と記号 を、ご投稿ください。</p>
    </div>
    <div id="form"></div>
</div>

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

    $(function() {
        $("#flash").load("flash.php");
        $("#sign").load("log.php");
        $("#form").load("submit.html");
    })

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