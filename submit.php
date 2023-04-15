<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set("Asia/Tokyo");

$month = date("m");
$day = date("d");
$source_file = "collection/". $month ."/". $day . ".csv";

define("LOGFILE", $source_file);
$data = json_decode(file_get_contents("php://input"), true);

$output = array(
  $data["symbol"],
  $data["color"],
  $data["timestamp"],
  $_SERVER["REMOTE_ADDR"]
);

$result = implode(',', $output);
file_put_contents(LOGFILE, $result."\n", FILE_APPEND | LOCK_EX);
echo json_encode($output);
?>
