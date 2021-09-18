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
<script src="/coding/js/random.js"></script>
<script type="text/javascript">
$(function(){
$("#org").load("org.php");
})
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
<link rel="stylesheet" type="text/css" href="/sign/symbol_color.css" />
<title>令和三年三月 | 自分の気持ちを知る・表す
</title>
<style type="text/css">
body {overflow-x:hidden;}
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

#bg_random {
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
  position:fixed;
  bottom:0; left:0;
  padding:0; margin:0;
  width:100%;
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
#org {
  position:relative;
  top:0; left:0;
  padding:0; margin:0;
  width:100%; z-index:100;
}
@media screen and (max-width: 550px){
  .bg_symbol {font-size:20vw;}
}
</style>
</head>
<body>

<span id="bg_link">
<a><b>自分の気持ちを知る・表す</b></a>
<br/>
<i>令和三年三月</i></span>

<ul id="symbol_color">
<li id="bg_color" style="background-image: linear-gradient(0deg,
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
#<?=h($row[1])?>,
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
#fff);">
</li>
</ul>

<div id="org"></div>

<ul id="random" class="slide">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li>
<span id="bg_random" style="background:#<?=h($row[1])?>;">
<span id="bg_symbol"><?=h($row[0])?></span>
</span>
</li>
<?php endforeach; ?>
<?php else: ?>
<li>
<span id="bg_random" style="background:#<?=h($row[1])?>;">
<span id="bg_symbol"><?=h($row[0])?></span>
</span>
</li>
<?php endif; ?>
</ul>
<section id="post">
<input type="range" id="slide_speed" value="7500" min="5000" max="10000">
</section>
</body>
