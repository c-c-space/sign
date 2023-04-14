<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$title = "令和三年三月から令和三年九月";

$site = "http".(isset($_SERVER["HTTPS"])?"s":"")."://"."{$_SERVER["HTTP_HOST"]}";
$url = "{$site}"."{$_SERVER['REQUEST_URI']}";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
  <title>自分の気持ちを知る表す</title>
  <meta name="description" content="<?php echo $title ."の色と記号";?>">
  <meta property="og:title" content="自分の気持ちを知る表す">
  <meta property="og:description" content="<?php echo $title ."の色と記号";?>">
  <meta property="og:site_name" content="<?php echo $site;?>">
  <meta property="og:url" content="<?php echo $url;?>" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="ja_JP" />
  <meta property="og:image" content="<?php echo $url;?>card.png" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:image" content="<?php echo $url;?>card.png" />

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="../style.css" />

  <link rel="icon" href="icon.png" type="image/png">
  <link rel="apple-touch-icon-precomposed" href="icon.png" type="image/png">
  <style type="text/css">
  header {
    mix-blend-mode: difference;
  }

  #js-button,
  #contents a {
    filter: invert();
  }
  </style>
</head>

<body>
  <script src="/js/menu.js"></script>
  <header id="menu" hidden>
    <button id="js-button"><b></b></button>
    <nav id="contents">
      <a href="/" target="_parent">
        <p><b>creative-community.space</b></p>
        <u>Index</u>
      </a>
      <a href="/sign/" target="_parent">
        <i>Colors and Symbols that Suits on You</i>
        <p>自分の気持ちを知る・表す</p>
      </a>
      <a href="/sign/log/" target="_parent">
        <i>View The Collection</i>
        <p>今月の色と記号</p>
      </a>
    </nav>
  </header>

  <nav id="log" class="hidden">
    <select>
      <option selected disabled>令和三年三月から令和三年九月</option>
    </select>
  </nav>

  <section id="collection">
    <iframe src="202103.php"></iframe>
    <iframe src="202104.php"></iframe>
    <iframe src="202105.php"></iframe>
    <iframe src="202106.php"></iframe>
    <iframe src="202107.php"></iframe>
    <iframe src="202108.php"></iframe>
  </section>

  <script src="script.js"></script>
</body>
</html>
