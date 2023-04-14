<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no" />

  <script src="/js/index.js" async></script>

  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="../css/collection.css" />

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
    </nav>
  </header>

  <nav id="log" class="hidden">
    <select>
      <option selected disabled>令和三年三月から令和三年九月</option>
    </select>
  </nav>

  <section id="collection">
    <iframe src="202103/"></iframe>
    <iframe src="202104/"></iframe>
    <iframe src="202105/"></iframe>
    <iframe src="202106/"></iframe>
    <iframe src="202107/"></iframe>
    <iframe src="202108/"></iframe>
  </section>

  <script src="script.js"></script>
</body>
</html>
