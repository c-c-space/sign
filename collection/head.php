<?php
$fp = fopen($source_file, 'a+b');
$post = sizeof(file($source_file));

$site = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
$url = "{$site}" . "{$_SERVER['REQUEST_URI']}";

mb_language("ja");
mb_internal_encoding("UTF-8");

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

while ($row = fgetcsv($fp)) {
  $rows[] = $row;
}

fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
  <script src="/ver/js/menu.js"></script>

  <!--og:meta-->
  <meta content="website" property="og:type">
  <title><?php echo $month; ?> 月 <?php echo $day; ?> 日 の気持ちを知る・表す</title>
  <meta content="<?php echo $month; ?> 月 <?php echo $day; ?> 日 の気持ちを知る・表す" property="og:title">
  <meta content="これは、18 の色 と 35 の記号 を使って 自分の気持ちを知る・表す オンラインコミュニケーションツールです。" name="description">
  <meta content="これは、18 の色 と 35 の記号 を使って 自分の気持ちを知る・表す オンラインコミュニケーションツールです。" name="og:description">

  <!--for Twitter-->
  <meta content="summary_large_image" name="twitter:card">
  <meta content="<?php echo $url; ?>" property="og:url">
  <meta content="<?php echo $site . "/sign/summary.png"; ?>" property="og:image">
  <meta content="<?php echo $site . "/sign/summary.png"; ?>" name="twitter:image:src">

  <link rel="icon" href="/sign/img/favicon.png">
  <link rel="icon" href="/sign/img/android.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="/sign/img/ios.png" sizes="180x180">

  <meta name="application-name" content="creative-community.space" />
  <meta name="msapplication-TileImage" content="/sign/img/favicon.png" />
  <meta name="msapplication-square70x70logo" content="/sign/img/favicon.png" />
  <meta name="msapplication-square150x150logo" content="/sign/img/ios.png" />
  <meta name="msapplication-wide310x150logo" content="/sign/img/cover.png" />
  <meta name="msapplication-square310x310logo" content="/sign/img/twitter.png" />
  <meta name="msapplication-TileColor" content="#fff" />

  <link rel="stylesheet" href="/ver/css/menu.css" />
  <link rel="stylesheet" href="/sign/css/style.css" />
  <link rel="stylesheet" href="/sign/css/all.css" />
  <link rel="stylesheet" href="/sign/css/flash.css" />