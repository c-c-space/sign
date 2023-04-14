<?php
require('function.php');
?>

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
    </nav>
  </header>

  <main>
    <section id="all">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php foreach ($rows as $row) : ?>
            <li>
              <p>
                <u style="background:#<?= h($row[1]) ?>;">
                  <span style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></span>
                </u>
                <b style="color:#<?= h($row[1]) ?>;"><?= h($row[2]) ?></b>
              </p>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li>
            <p>
              <u style="background:#000;">
                <span style="color:#000;">?</span>
              </u>
              <b>Nothing Here</b>
            </p>
          </li>
        <?php endif; ?>
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

      <script src="js/flash.js"></script>
    </section>

    <nav id="now">
      <button type="button" id="allBtn" onclick="allView()">
        <span>
          <?php
          print(date('n 月 j 日') . " ($week_name[$w])")
          ?>
        </span>
      </button>
      <button type="button" onclick="flashView()">
        <time id="showTime"></time>
      </button>
    </nav>
    <script type="text/javascript">
    function set10(num) {
      let ret;
      if (num < 10) { ret = "0" + num; }
      else { ret = num; }
      return ret;
    }

    function nowOn() {
      const nowTime = new Date();
      const nowHour = set10(nowTime.getHours());
      const nowMin = set10(nowTime.getMinutes());
      const nowSec = set10(nowTime.getSeconds());
      const showTime = nowHour + ":" + nowMin + ":" + nowSec;
      document.querySelector("#showTime").textContent = showTime;
    }

    setInterval('nowOn()', 1000);
    </script>
  </main>

  <form id="submit" class="hidden" method="post" hidden></form>
  <script src="js/submit.js"></script>

  <script src="js/readyState.js"></script>
</body>
</html>
