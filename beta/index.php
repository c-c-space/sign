<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$date = (string)filter_input(INPUT_POST, 'date'); // $_POST['date']
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']

$fp = fopen('index.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color]);
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
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>自分の気持ちを知る・表す</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
        
        .library {
            padding: 0;
            margin: 0;
            height: 100vh;
            white-space: nowrap;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .library>* {
            display: inline-block;
        }
        
        .library li {
            width: 45rem;
            height: 99.5%;
            max-width: 90vw;
            overflow: hidden;
        }
        
        .library li iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .library::-webkit-scrollbar {
            width: 0;
            height: 4.5vh;
            background-size: 400% 400%;
            animation: gradientBG 5s ease infinite;
            background: linear-gradient(-90deg, #fffafa, #483d8b, #f0ffff, #f0ffff, #d2b48c, #0000cd, #ff8c00, #008080, #808080, #fffafa, #fff000, #fffafa, #b0c4de, #808080, #b0c4de, #d2b48c, #808080, #ffdab9, #b0c4de, #808080, #ba55d3, #ff0000, #90ee90, #fff);
        }
        
        .library::-webkit-scrollbar-thumb {
            background: #fff;
        }
        
        @media screen and (max-width: 550px) {
            .library {
                height: 85vh;
            }
            .library::-webkit-scrollbar {
                height: 0;
            }
        }
        
        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body>
    <ul class="mousedragscrollable library">
        <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
        <li><iframe src="<?=h($row[1])?>"></iframe></li>
        <?php endforeach; ?>
        <?php else: ?>
        <?php endif; ?>
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/mousedragscrollable/scrollable.js"></script>
</body>

</html>