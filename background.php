<?php

$today = date("Ymd");
$source_file =  $today . ".csv";

$fp = fopen($source_file, 'a+b');

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>自分の気持ちを知る・表す</title>
    <link rel="stylesheet" href="background.css" />
</head>

<body>
    <main id="gradient">
        <section class="bg" style="background-image: linear-gradient(180deg,
            <?php if (!empty($rows)) : ?>
            <?php foreach ($rows as $row) : ?>
            #<?= h($row[1]) ?>,
            <?php endforeach; ?>
            <?php else : ?>
            #000,
            <?php endif; ?>
            #fff);">
        </section>
    </main>
</body>

</html>