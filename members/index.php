<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$month = "202109";
if (isset($_GET["month"])) {
  $month = $_GET["month"];
}

$source_file = $month . ".csv";
$fp = fopen($source_file, 'a+b');
$post = sizeof(file($source_file));

function h($str) {
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
  <script src="/js/index.js" async></script>
  <link rel="stylesheet" href="/css/menu.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/viewall.css" />
  <link rel="stylesheet" href="../css/flash.css" />

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
  <?php if (!empty($rows)) : ?>
  <?php foreach ($rows as $row) : ?>
  #<?= h($row[1]) ?>,
  <?php endforeach; ?>
  <?php else : ?>
  #aaa,
  <?php endif; ?>
  #fff)">

  <header id="menu" hidden>
    <button id="js-button"><b></b></button>
    <nav id="contents">
      <a href="/sign/" target="_parent">
        <i>Colors and Symbols that Suit You</i>
        <p>自分の気持ちを知る・表す</p>
      </a>
    </nav>
  </header>
  <script src="/js/menu.js"></script>

  <main>
    <?php require('../beta/viewall.php'); ?>
  </main>
  <script src="../js/flash.js"></script>
  <script src="../js/viewall.js"></script>

  <form id="now" class="hidden" method="GET">
    <section>
      <button type="button" onclick="allView()">
        <span><?php echo $month;?></span>
      </button>
      <button type="button" onclick="flashView()">
        <span><?php echo $post;?> の色と記号</span>
      </button>
    </section>
    <section>
      <select id="month" name="month">
        <option disabled selected hidden>Members Only</option>
      </select>
      <button type="submit">View The Collection</button>
    </section>
    <script src="script.js"></script>
  </form>
</body>
</html>
