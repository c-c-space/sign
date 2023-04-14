<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$title = '令和三年四月';
$year = "2021";
$month = "04";

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
  <meta property="og:image" content="<?php echo $url;?>card.png" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:image" content="<?php echo $url;?>card.png" />

  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../css/flash.css" />
  <link rel="stylesheet" href="../css/viewall.css" />

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

<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)):?>
  <?php foreach ($rows as $row):?>
  #<?= h($row[1])?>,
  <?php endforeach;?>
  <?php else:?>
  #000,
  <?php endif;?>
  #fff);">

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
      <option selected disabled>自分の気持ちを知る・表す</option>
    </select>
  </nav>

  <form id="now" class="hidden" method="GET">
    <button type="button" onclick="flashView()">
      <span id="title"><?php echo $title;?></span>
    </button>
    <button type="button" id="allBtn" onclick="allView()">
      <span><?php echo $post;?> の色と記号</span>
    </button>
  </form>

  <main>
    <section id="all">
      <ul>
        <?php if (!empty($rows)):?>
          <?php foreach ($rows as $row):?>
            <li style="background:#<?= h($row[1])?>;">
              <span style="color:#<?= h($row[1])?>;"><?= h($row[0])?></span>
            </li>
          <?php endforeach;?>
        <?php else:?>
          <li style="background:#000;">
            <span style="color:#fff;">?</span>
          </li>
        <?php endif;?>
      </ul>
    </section>

    <section id="flash">
      <ul>
        <?php if (!empty($rows)):?>
          <?php shuffle($rows); foreach ($rows as $row):?>
            <li style="background:#<?= h($row[1])?>;">
              <b style="color:#<?= h($row[1])?>;"><?= h($row[0])?></b>
            </li>
          <?php endforeach;?>
        <?php else:?>
          <li style="background:#aaa;">
            <b style="color:#aaa;">?</b>
          </li>
        <?php endif;?>
      </ul>
      <section id="speed">
        <input id="flash_speed" type="range" value="" min="500" max="5000">
      </section>
      <script src="../js/flash.js" async></script>
    </section>
  </main>

  <script src="script.js"></script>
</body>
</html>
