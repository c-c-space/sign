<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$title = "令和三年三月";
$year = "2021";
$month = "03";

//JSONデータを受け取り連想配列に変換
$data = json_decode(file_get_contents('php://input'), true);

$output = array(
  "title" => $data["title"],
  "year" => $data["year"],
  "month" => $data["month"]
);

echo json_encode($output);

$source_file = $year . $month . $day . ".csv";
$fp = fopen($source_file, "a+b");
$post = sizeof(file($source_file));

$description = $post. 'の色と記号';

$site = "http".(isset($_SERVER["HTTPS"])?"s":"")."://"."{$_SERVER["HTTP_HOST"]}";
$url = "{$site}"."{$_SERVER['REQUEST_URI']}";

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>
