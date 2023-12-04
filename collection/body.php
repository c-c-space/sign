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
    <button type="button"><b></b></button>
    <menu id="contents">
      <a href="/" target="_parent">
        <p>creative-community.space</p>
        <u>Index</u>
      </a>
    </menu>
  </header>

  <main>
    <section id="all">
      <p class="you">
        <i>Sign | creative-community.space</i>
        <u style="color:#fff;"><?php echo $month; ?> 月 <?php echo $day; ?> 日 の気持ちを知る・表す</u>
        <small id="gradient" hidden></small>
      </p>
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
              <b style="color:#fff;">Nothing Here</b>
            </p>
          </li>
        <?php endif; ?>
      </ul>
    </section>

    <section id="flash">
      <ul>
        <?php if (!empty($rows)) : ?>
          <?php shuffle($rows);
          foreach ($rows as $row) : ?>
            <li style="background:#<?= h($row[1]) ?>;">
              <b style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></b>
            </li>
          <?php endforeach; ?>
        <?php else : ?>
          <li style="background:#aaa;">
            <b style="color:#aaa;">?</b>
          </li>
        <?php endif; ?>
      </ul>
      <section id="speed">
        <input id="flash_speed" type="range" value="" min="500" max="5000">
      </section>
    </section>

    <form id="now" method="GET">
      <section id="viewall">
        <button type="button" onclick="allView()">
          <span><?php echo $month; ?> 月 <?php echo $day; ?> 日</span>
        </button>
        <button type="button" onclick="flashView()">
          <span><?php echo $post; ?> の色と記号</span>
        </button>
      </section>
      <section id="members"></section>
    </form>

    <script src="/sign/js/flash.js"></script>
    <script src="/sign/js/viewall.js"></script>
  </main>