<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$symbol = (string)filter_input(INPUT_POST, 'symbol'); // $_POST['symbol']
$color = (string)filter_input(INPUT_POST, 'color'); // $_POST['color']

$fp = fopen('symbol_color.csv', 'a+b');
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
$("#").load("");
})
</script>
<link rel="stylesheet" type="text/css" href="/sign/symbol_color.css" />
<title>自分の気持ちを知る・表す | creative-community.space</title>
<style type="text/css">
body  {overflow-x:hidden;}
#bg_link {
  position:absolute;
  z-index:100;
  top:0;
  right:0;
  color:#000;
  line-height:1.5rem;
  letter-spacing:.1rem;
  font-family: "MS 明朝","MS Mincho", serif;
  font-size:0.9rem;
  text-decoration:none;
  display:inline-block;
  -ms-writing-mode: tb-rl;
  writing-mode: vertical-rl;
	transition:.5s all;
}
#bg_link b {
  color:#000;
  font-weight:500;
  line-height:1.5rem;
  letter-spacing:.1rem;
  font-family: "MS 明朝","MS Mincho", serif;
  background:#fff;
  text-decoration:none;
  padding:0.5rem 0.25rem;
}
#bg_link i {padding:0.5rem 0.25rem;}

#bg_color {
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
#bg_link {display: none;}
#bg_color {
  background-size: 100% 100%;
  animation: gradient none;
}
}
</style>
</head>
<body>

<span id="bg_link">
<b>自分の気持ちを知る・表す</b><br/>
<i>
<?php
$mod = filemtime("symbol_color.csv");
date_default_timezone_set('Asia/Tokyo');
print "".date("m.d.y H:i",$mod);
?>
</i> 更新</span>

<ul id="symbol_color">
<li id="bg_color" style="background-image: linear-gradient(180deg,
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
