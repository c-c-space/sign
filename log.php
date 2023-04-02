<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
date_default_timezone_set("Asia/Tokyo");

$month = date("Ym");
$day = date("d");
$source_file = "log/". $month . $day . ".csv";

$timestamp = date("j.M.y.D g:i:s A");
$forwardedFor = $_SERVER["REMOTE_ADDR"];
$ips = explode(",", $forwardedFor);
$ip = $ips[0];

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
