<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$word = (string)filter_input(INPUT_POST, 'word');
$weight = (string)filter_input(INPUT_POST, 'weight');
$size = (string)filter_input(INPUT_POST, 'size');
$feel = (string)filter_input(INPUT_POST, 'feel');

$fp = fopen('org.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$word, $weight, $size, $feel,]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> 令和三年三月 | 言葉の強さと方向と感情 </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/coding/js/org.js"></script>
<script type="text/javascript">
$(function(){
$("#").load("");
})
</script>
<link rel="stylesheet" href="/sign/org.css"/>
<style type="text/css">
</style>
</head>
<body>
<div id="header">
<span>言葉の強さと方向と感情</span>
</div>

<form id="org" style="display:;">
<div>
<div class="search-box feel">
<ul>
<li>
<input type="radio" name="feel" value="happy" id="happy">
<label for="happy" class="label">🙂</label></li>
<li>
<input type="radio" name="feel" value="hearts" id="hearts">
<label for="hearts" class="label">🥰</label></li>
<li>
<input type="radio" name="feel" value="tongue" id="tongue">
<label for="tongue" class="label">😜</label></li>
<li>
<input type="radio" name="feel" value="thinking" id="thinking">
<label for="thinking" class="label">🤔</label></li>
<li>
<input type="radio" name="feel" value="neutral" id="neutral">
<label for="neutral" class="label">😐</label></li>
<li>
<input type="radio" name="feel" value="relieved" id="relieved">
<label for="relieved" class="label">😌</label></li>
<li>
<input type="radio" name="feel" value="dizzy" id="dizzy">
<label for="dizzy" class="label">😵</label></li>
<li>
<input type="radio" name="feel" value="frowning" id="frowning">
<label for="frowning" class="label">😮</label></li>
<li>
<input type="radio" name="feel" value="crying" id="crying">
<label for="crying" class="label">😢</label></li>
<li>
<input type="radio" name="feel" value="steam" id="steam">
<label for="steam" class="label">😤</label></li>
</ul>
</div>
<div class="reset">
<input type="reset" name="reset" value="RESET" class="reset-button">
</div>
</div>
</form>

<div class="org_list">
<div id="inside">
<ul id="random">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-weight="<?=h($row[1])?>" data-size="<?=h($row[2])?>" data-feel="<?=h($row[3])?>"><span class="<?=h($row[1])?> <?=h($row[2])?>"><?=h($row[0])?></span></li>
<?php endforeach; ?>
<?php else: ?>
<li class="list_item list_toggle" data-weight="<?=h($row[1])?>" data-size="<?=h($row[2])?>" data-feel="<?=h($row[3])?>"><span class="<?=h($row[1])?> <?=h($row[2])?>">keyword</span></li>
<?php endif; ?>
</ul>
</div>
</div>
</body>
</html>
