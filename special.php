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
<script src="http://creative-community.pe.hu/coding/js/random.js"></script>
<link rel="stylesheet" type="text/css" href="/index.css" />
<title>完了 | 自分の気持ちを知る・表す</title>
<style type="text/css">
html,body {
  font-family: "YuGothic","Yu Gothic","游ゴシック体";
  font-weight: 500;
  padding:0; margin:0;
}
.slide {
  position:relative;
  top:0; left:0;
  padding:0; margin:0;
  width:100%; height:100vh;
  display: flex;
}
.slide li {
  opacity:0;
  width:100%;
  height:100%;
  display:block;
  top:0; left:0;
  padding:0; margin:0;
  list-style: none;
  position:absolute;
  transition:all 0s ease-in-out;
}

#bg_color {
  width:100%;
  height:100%;
  display:block;
  top:0; left:0;
  padding:0; margin:0;
}
#bg_symbol {
  z-index:10;
  position:absolute;
  padding:0; margin:0;
  font-size:15vw;
  top:50%; left:50%;
  transform:translate(-50%,-50%);
  -webkit-transform:translate(-50%,-50%);
}
#slide_speed {transform:rotateY(180deg);}
#post {
  z-index:100;
  position:fixed;
  top:0; left:0;
  padding:0; margin:0;
  width:100%; height:100vh;
}
#post input[type="range"] {
  width:95%;
  position:absolute;
  bottom:0; left:0;
  -webkit-appearance: none;
  appearance: none;
  cursor: pointer;
  outline: none;
  background-color:rgba(255,255,255,0.25);
  border-radius: 5rem;
  padding:0; margin:2.5%;
}
.onmouse_button {
  position:absolute;
  z-index:100;
  top:0;
  left:0;
  color:#000;
  background:#fff;
  font-size:0.9rem;
  text-decoration:none;
  line-height:1.5rem;
  letter-spacing:.1rem;
  font-family: "MS 明朝","MS Mincho", serif;
  margin:auto;
  padding:0.125rem 0.25rem;
  display:block;
}
#onmouse {
  pointer-events:none;
  position:fixed;
  width:100%;
  height:100%;
  bottom:0; left:0;
  opacity: 0;
  background-color:rgba(255,255,255,0.25);
  transition:.5s all;
}

@media screen and (max-width: 550px){
  .bg_symbol {font-size:20vw;}
}
</style>
<script>
window.addEventListener('load', function () {
	viewSlide('.slide li');
});
function viewSlide(className, slideNo = -1)
{
	let imgArray = document.querySelectorAll(className);
	if (slideNo >= 0) {
		imgArray[slideNo].style.opacity = 0;
	}
	slideNo++;
	if (slideNo >= imgArray.length) {
		slideNo = 0;
	}
	imgArray[slideNo].style.opacity = 1;
	let msec = document.getElementById('slide_speed').max - document.getElementById('slide_speed').value;
	setTimeout(function(){viewSlide(className, slideNo);}, msec);
}
</script>
</head>
<body>
<ul id="random" class="slide">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<span id="bg_color" style="background:#<?=h($row[1])?>;">
<span id="bg_symbol"><?=h($row[0])?></span>
</span>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<span id="bg_color" style="background:#<?=h($row[1])?>;">
<span id="bg_symbol"><?=h($row[0])?></span>
</span>
</li>
<?php endif; ?>
</ul>
<section id="post">
<input type="range" id="slide_speed" value="7500" min="5000" max="10000">
</section>
</body>
