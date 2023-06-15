<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$source_file = "log.csv";
$fp = fopen($source_file, "a+b");
$post = sizeof(file($source_file));

$description = $post .'の色と記号';

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

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
  <title><?php echo $title ."の気持ちを知る・表す";?></title>
  <meta name="description" content="<?php echo $title ."の気持ちを知る・表す". $description;?>">
  <meta property="og:title" content="<?php echo $title ."の気持ちを知る・表す"; ?>">
  <meta property="og:description" content="<?php echo $title ."の気持ちを知る・表す". $description;?>">
  <meta property="og:site_name" content="<?php echo $site;?>">
  <meta property="og:url" content="<?php echo $url;?>" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="ja_JP" />
  <meta property="og:image" content="../card.png" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:image" content="../card.png" />
  <link rel="stylesheet" href="/css/menu.css" />
  <link rel="stylesheet" href="../../style.css" />
  <link rel="stylesheet" href="../../css/flash.css" />
  <link rel="stylesheet" href="../../css/viewall.css" />
  <link rel="icon" href="../icon.png" type="image/png">
  <link rel="apple-touch-icon-precomposed" href="../icon.png" type="image/png">
  <style type="text/css">
  html {
    height: -webkit-fill-available;
  }

  body {
    min-height: -webkit-fill-available;
  }
  </style>
</head>
