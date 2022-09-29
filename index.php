<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>自分の気持ちを知る・表す</title>
    <meta name="description" content="これは、35 の 記号 と 18 の 色 を使って 自分の気持ちを知る・表す コミュニケーションツール です。">

    <meta property="og:title" content="自分の気持ちを知る・表す" />
    <meta property="og:description" content="これは、35 の 記号 と 18 の 色 を使って 自分の気持ちを知る・表す コミュニケーションツール です。" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://creative-community.space/sign/" />
    <meta property="og:image" content="イメージファイルのURL（1200x630 以上、8MB 以下、縦横比 1.91:1 の画像を推奨）" />
    <meta property="og:locale" content="ja_JP" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="icon" sizes="32x32" href="ファビコンのURL (ICO or PNG,GIF)">
    <link rel="icon" sizes="192x192" href="アンドロイド端末用WEBクリップアイコンのURL (PNG)">
    <link rel="apple-touch-icon" sizes="180x180" href="アップル端末用WEBクリップアイコンのURL (PNG)">

    <link rel="stylesheet" href="index.css" />
</head>

<body id="open">

    <div id="menu" class="nlc">
        <div>
            <a class="tab" href="#all">
                <?php
                date_default_timezone_set('Asia/Tokyo');
                print(date('Y 年 n 月 j 日'). " ($week_name[$w])")
                ?>
            </a>
            <span class="check"><b>✔</b></span>
        </div>
        <div>
            <a id="showTime" class="tab" href="#flash"></a>
            <span class="check"><b>✔</b></span>
        </div>
    </div>

    <div id="background"></div>
    <div id="all" class="change"></div>
    <div id="flash" class="change"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script src="now.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#background").load("gradient.php");
            $("#all").load("all.php");
            $("#flash").load("flash.php");
        })
    </script>
</body>

</html>