<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$date = (string)filter_input(INPUT_POST, 'date'); // $_POST['date']
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']

$fp = fopen('index.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color]);
    rewind($fp);
}
flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>自分の気持ちを知る・表す</title>
    <style type="text/css">
    </style>
    
    <!-- Import the webpage's stylesheet -->
    <link rel="stylesheet" href="index.css" />
  
  </head>
  <body>
    <ul class="mousedragscrollable library">
      <?php if (!empty($rows)): ?>
        <?php foreach ($rows as $row): ?>
          <li><iframe src="<?=h($row[1])?>"></iframe></li>
          <?php endforeach; ?>
        <?php else: ?>
      <?php endif; ?>
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://creative-community.space/coding/js/mousedragscrollable/scrollable.js"></script>
  </body>
</html>
