<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']
$timestamp = time() ;

$forwardedFor = $_SERVER["HTTP_X_FORWARDED_FOR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$fp = fopen('symbol_color.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip]);
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
<link rel="stylesheet" type="text/css" href="" />
<title>自分の気持ちを知る・表す</title>
<style type="text/css">
#log {
  font-size:4vw;
  width:45%;
  height:70vh;
  margin:12.5vh auto;
  background:rgba(255,255,255,0.75);
  overflow-y:auto;
}
#log_items {
  list-style: none;
  display: -webkit-flex;
  display: flex;
  -webkit-align-items: flex-start;
  align-items: flex-start;
  -webkit-flex-direction: column-reverse;
  flex-direction: column-reverse;
}
#log_items li {
  width:100%;
  position:relative;
  margin:0;
}
#log_items p {
  margin:0;
  font-size:75%;
  line-height:150%;
}
#log_items b {
  font-size:150%;
}
#log_items i {
  font-size:125%;
}
</style>
</head>
<body>
<div id="log">
<ul id="log_items">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<p>IP <b><?=h($row[3])?></b><br/>
Posted on <i><?=h($row[2])?></i></p>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<p>IP <b>000.00.00.00</b><br/>
Posted on <i>00.00.00 00:00</i></p>
</li>
<?php endif; ?>
<li>
<u>投稿履歴</u>
</li>
</ul>
</div>
</body>
</html>
