<?php

date_default_timezone_set('Asia/Tokyo');

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$today = date("Ymd");
$source_file =  "../" . $today . ".csv";

$fp = fopen($source_file, 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$symbol, $color, $timestamp, $ip,]);
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
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>自分の気持ちを知る・表す</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body id="gradient" class="bg" style="background-image: linear-gradient(180deg,
<?php if (!empty($rows)) : ?>
    <?php foreach ($rows as $row) : ?>
        #<?= h($row[1]) ?>,
        <?php endforeach; ?>
        <?php else : ?>
        #000,
        <?php endif; ?>
    #fff);">
</body>

</html>