<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$source_file = "symbol_color.csv";
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
    <title>令和三年三月 | 自分の気持ちを知る・表す</title>
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
        
        #update {
            position: fixed;
            top: 2.5vw;
            right: 2.5vw;
            z-index: 50;
            color: #000;
            border-radius: 50%;
            text-decoration: none;
            transition: .5s all;
            width: 3vw;
            height: 3vw;
        }
        
        #update:hover {
            cursor: pointer;
            color: #fff;
            transition: 1s all;
        }
        
        #update b {
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
        #sign {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }
        
        #background {
            z-index: -1;
        }
        
        #flash iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        @media screen and (max-width: 550px) {
            #update {
                z-index: 50;
                width: 2rem;
                height: 2rem;
            }
            #update b {
                letter-spacing: .1rem;
                font-size: 1.5rem;
            }
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
                margin-top: 12.5vh;
                height: 85vh;
                margin-bottom: 2.5vh;
                background-size: 100% 100%;
                animation: gradient none;
            }
            
            #menu,
            #update,
            #index {
                display: none;
            }
        }
    </style>
</head>

<body>
    <a id="update" href="print.pdf" target="_parent">
        <b>⎷</b>
    </a>

    <div id="menu" class="nlc">
        <div>
            <a class="tab" href="#sign">March 2021</a>
            <span class="check"><b>✔</b></span>
        </div>
        <div>
            <a class="tab" href="#flash">View The Collection</a>
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
    <div id="sign" class="change"></div>
    <div id="flash" class="change"><iframe src="flash.php"></iframe></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#sign").load("log.php");
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