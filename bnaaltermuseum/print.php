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
    <style>
        body,
        #sign {
            padding: 0;
            margin: 0;
        }
        
        #mod {
            position: relative;
            top: 0;
            width: 100%;
            height: auto;
            background-color: #fff;
            border-bottom: solid 1px #000;
            padding: 1rem 0 0;
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
        
        #collection {
            position: relative;
            font-size: 0.75rem;
            letter-spacing: .5rem;
            padding: 0.125rem 0;
            margin: 1rem 0 0;
            border-top: 1px solid #000;
        }
        
        #collection marquee {
            display: block;
        }
        
        #collection ul {
            padding: 0;
            margin: 0 0.5rem;
            min-height:1.5rem;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            display: -ms-flexbox;
            display: flex;
            white-space: nowrap;
            -webkit-justify-content: space-between;
            justify-content: space-between;
            -webkit-flex-direction: row-reverse;
            flex-direction: row-reverse;
        }
        
        #collection li {
            list-style: none;
            position: relative;
            display: block;
            width: 1.5rem;
            height: 1.5rem;
            min-width: 1.5rem;
            min-height: 1.5rem;
            white-space:normal;
            padding: 0;
            margin: 0.25rem 0.5rem;
        }
        
        #collection i {
            display:inline-block;
            padding: 0.25rem 0 0;
        }
        
        #collection li b {
            position: absolute;
            display: inline-block;
            font-size:1rem;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        
        #sign {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: -1;
            width: 100%;
            height: 87.5vh;
            overflow: hidden;
            pointer-events: none;
            user-select: none;
        }
        
        #credit .display {
            display:block;
        }

        #credit .print {
            display:block;
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

        #date {
            position:fixed;
            bottom:0;
            width:100%;
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
            padding: 0.5rem;
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
            padding: 0.5rem;
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
        <div id="collection">
                <ul class="flash">
                    <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                    <li style="background:#<?=h($row[1])?>;">
                        <b class="symbol" style="color:#<?=h($row[1])?>; filter: invert();"><?=h($row[0])?></b>
                    </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <i style="color:#000;">No Posts Yet, Today</i>
                    <?php endif; ?>
                </ul>
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


    <form id="date" action="" method="POST">
        <select name="today">
            <option value="">自分の気持を知る・表す</option>
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
        <input type="submit" name="submit" value="View The Collection"/>
    </form>

</body>

</html>
