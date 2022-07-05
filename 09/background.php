<?php

date_default_timezone_set('Asia/Tokyo');

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("d");
$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = date("g:i:s A \J\S\T");
$filename =  $today . ".csv"; 

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen($filename, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $today, $ip,]);
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
            body {
                padding: 0;
                margin: 0;
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
                    background-size: 100% 100%;
                    animation: gradient none;
                }
            }
        </style>
    </head>

    <body>

        <ul id="gradient">
            <li class="bg" style="background-image: linear-gradient(0deg,
            <?php if (!empty($rows)): ?>
            <?php foreach ($rows as $row): ?>
            #<?=h($row[1])?>,
            <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
            #fff);">
            </li>
        </ul>
    </body>

    </html>