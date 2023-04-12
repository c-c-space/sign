<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set("Asia/Tokyo");

$month = date("Ym");
$day = date("d");
$source_file = "log/". $month ."/". $day . ".csv";

$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");
$timestamp = date('Y年n月j日') . "($week_name[$w]) " .date("g:i:s A");

define("LOGFILE", $source_file);
$data = json_decode(file_get_contents("php://input"), true);

$output = array(
  $data["symbol"],
  $data["color"],
  $timestamp,
  $ip
);

$result = implode(',', $output);
file_put_contents(LOGFILE, $result."\n", FILE_APPEND | LOCK_EX);
echo json_encode($output);
