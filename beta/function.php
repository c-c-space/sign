<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$source_file = "log.csv";
$fp = fopen($source_file, "a+b");
$post = sizeof(file($source_file));

$description = $post . 'の色と記号';

$site = "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . "{$_SERVER["HTTP_HOST"]}";
$url = "{$site}" . "{$_SERVER['REQUEST_URI']}";

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

  <!--og:meta-->
  <meta content="website" property="og:type">
  <title><?php echo $title . "の色と記号"; ?></title>
  <meta content="<?php echo $title . "の色と記号"; ?>" property="og:title">
  <meta content="<?php echo $title . " の気持ちを知る・表す " . $description . " の 色と記号"; ?>" name="description">
  <meta content="<?php echo $title . " の気持ちを知る・表す " . $description . " の 色と記号"; ?>" name="og:description">

  <meta property="og:url" content="<?php echo $url; ?>" />
  <link rel="stylesheet" href="/sign/css/style.css" />
  <link rel="stylesheet" href="/sign/css/flash.css" />
  <link rel="icon" href="../icon.png" type="image/png">
  <style type="text/css">
    #all {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      opacity: 0;
      overflow: auto;
      height: 100%;
      width: 100%;
      transition: 2.5s;
      z-index: 0;
    }

    #all,
    #all * {
      box-sizing: border-box;
    }

    #all,
    #all ul {
      padding: 0;
      margin: 0;
    }

    #all ul {
      display: flex;
      font-size: 450%;
      flex-flow: wrap-reverse;
      list-style: none;
      list-style-position: inside;
      width: 100%;
    }

    #all ul li {
      font-family: 'Times New Roman', serif;
      display: grid;
      place-items: center;
      width: 100%;
      height: 100vh;
      max-height: -webkit-fill-available;
    }

    #all ul li span {
      filter: invert();
    }
  </style>
</head>