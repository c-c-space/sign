<?php require('collection.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />
  <script src="readyState.js"></script>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../css/all.css" />
  <link rel="stylesheet" href="../css/about.css" />
  <link rel="stylesheet" href="../css/flash.css" />
  <link rel="stylesheet" href="../css/submit.css" />
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
  #fff);">

  <script src="/js/menu.js"></script>
  <header id="menu" hidden>
    <button id="js-button"><b></b></button>
    <nav id="contents">
      <a href="/" target="_parent">
        <p><b>creative-community.space</b></p>
        <u>Index</u>
      </a>
    </nav>
  </header>
  <script src="/js/index.js" async></script>

  <main>
    <?php require('../viewall.php'); ?>
    <?php require('now.php'); ?>
  </main>
  <script src="../js/flash.js"></script>
  <script src="../js/viewall.js"></script>

  <form id="submit" class="hidden" method="post" hidden></form>
  <script src="../js/submit.js"></script>
  <script src="/js/log.js"></script>
</body>
</html>
