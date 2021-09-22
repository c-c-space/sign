<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = time() ;

$fp = fopen('symbol_color.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp,]);
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="symbol_color.css" />
<title>完了 | 自分の気持ちを知る・表す</title>
<style type="text/css">
#post #button {top:12.5%; text-decoration:none; color:#000;}
</style>
</head>
<body>
<section id="post">
<a id="button" href="/members/">Members Only</a>
</section>
  
<ul id="symbol_color">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li id="bg_color" style="background:#<?=h($row[1])?>;"><span id="bg_symbol" class="fontmotion"><?=h($row[0])?></span></li>
<?php endforeach; ?>
<?php else: ?>
<li id="bg_color" style="background:#fff;">
<span id="bg_symbol">✔</span>
</li>
<?php endif; ?>
</ul>
</body>
