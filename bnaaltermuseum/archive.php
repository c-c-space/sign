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
    <script src="https://creative-community.space/sign/flash.js"></script>

    <link rel="stylesheet" href="https://creative-community.space/sign/index.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/all.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/background.css" />
    <link rel="stylesheet" href="https://creative-community.space/sign/flash.css" />
    
    <style type="text/css">
        #background,
        #flash,
        #submit {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
        }

        #flash,
        #submit {
            z-index: 1;
        }
        
        #background {
            z-index: -1;
        }

        #date {
            position:fixed;
            top:0;
            margin: 1.25%;
            width:97.5%;
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
        
        #mod {
            display: none;
        }
        
        @media print {
        
        #mod {
            display: block;
            position: relative;
            top: 0;
            width: 100%;
            height: auto;
            background-color: #fff;
            padding: 1rem 0;
            margin: 0;
            color: #000;
            font-family: 'Times New Roman', serif;
            text-align: center;
        }
        
        #mod b {
            display: block;
            margin: 0;
            padding: 0;
        }
        
        #mod #ed {
            font-size: 3.33rem;
            padding: 0.25rem 0.25rem 0;
            transform: scale(0.60, 1.75);
        }
        
        #mod #credit,
        #mod #today {
            position: absolute;
            display: block;
            margin: 1rem;
        }
        
        #mod #today {
            top: 0;
            left: 0;
            width: 12.5rem;
            height: 5rem;
            padding: 0;
            border: solid 1px #000;
            font-weight: 500;
            font-stretch: condensed;
            font-variant: common-ligatures tabular-nums;
            display: inline-block;
            transform: scale(1, 1.1);
            word-spacing: -.25ch;
        }
        
        #mod sup {
            font-size: 0.75rem;
            line-height: 200%;
            width: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        
        #mod #credit {
            font-size: 0.55rem;
            text-align: right;
            height: 5rem;
            top: 0;
            right: 0;
            width: 12.5rem;
            text-align: justify;
            word-wrap: break-word;
            letter-spacing: 0.05em;
        }
        
        #mod #credit b {
            text-align: center;
            font-size: 150%;
            padding: 0.25rem 0 0.5rem;
            font-family: Arial, sans-serif;
        }


            #menu,
            #date {
                display: none;
            }
        }
    </style>
</head>

<body id="open">

<div id="menu" class="nlc">
    <div>
        <a class="tab" href="#flash">
            #<?php
            if(isset($_POST["today"])) {
                $today = $_POST["today"];
                echo $today;
            }
            ?>
        </a>
        <span class="check"><b>✔</b></span>
    </div>
    <div>
        <a id="showTime" class="tab" href="#log">
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

<div id="log" class="change">
    <div id="mod">
        <b id="ed">𝕿𝖍𝖊 𝕭𝖓𝕬 𝕿𝖎𝖒𝖊𝖘</b>
        <p id="today">
            <sup style="text-transform: uppercase;">
            #
            <?php
            if(isset($_POST["today"])) {
                $today = $_POST["today"];
                echo $today;
            }
            ?>
            <br/>自分の気持ちを表す色と記号
            </sup>
        </p>

        <div id="credit">
            <b class="print">Colors and Symbols</b>
            <span class="print">This is The Collection of Colors and Symbols That Fits On Today.</span>
            <span class="print">Those Colors and Symbols had Posted by Today's Visitors of BnA Alter Museum for Create this Work.</span>
        </div>
    </div>
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