<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set('Asia/Tokyo');
$day = date("d");
if (isset($_GET["day"])) {
  $day = $_GET["day"];
}

$year = date("Y");
$month = date("m");
$source_file = $month ."/". $day . ".csv";
$fp = fopen($source_file, 'a+b');

$post = sizeof(file($source_file));

$title = date("n") .'月の気持ちを知る・表す';
$description = $post. 'の色と記号';

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}
fclose($fp);
?>