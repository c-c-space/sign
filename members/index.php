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

  <!--og:meta-->
  <meta content="website" property="og:type">
  <title>自分の気持ちを知る・表す</title>
  <meta content="自分の気持ちを知る・表す" property="og:title">
  <meta content="<?php echo $month . " の気持ちを知る・表す " . $post . " の 色と記号"; ?>" name="description">

  <link rel="icon" href="icon.png" type="image/png">
  <link rel="stylesheet" href="/sign/css/style.css" />
  <link rel="stylesheet" href="/sign/css/flash.css" />
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

<body style="background-image: linear-gradient(0deg,
  <?php if (!empty($rows)) : ?>
  <?php foreach ($rows as $row) : ?>
  #<?= h($row[1]) ?>,
  <?php endforeach; ?>
  <?php else : ?>
  #aaa,
  <?php endif; ?>
  #fff)">
  <main>
    <?php require('../beta/viewall.php'); ?>
  </main>
  <script src="/sign/js/flash.js"></script>
  <script src="/sign/js/viewall.js"></script>

  <form id="now" class="hidden" method="GET">
    <section>
      <button type="button" onclick="allView()">
        <span><?php echo $month; ?></span>
      </button>
      <button type="button" onclick="flashView()">
        <span><?php echo $post; ?> の色と記号</span>
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