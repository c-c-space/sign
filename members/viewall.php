<section id="all">
  <ul>
    <?php if (!empty($rows)) : ?>
      <?php foreach ($rows as $row) : ?>
        <li style="background:#<?= h($row[1]) ?>;">
          <span style="color:#<?= h($row[1]) ?>;"><?= h($row[0]) ?></span>
        </li>
      <?php endforeach; ?>
    <?php else : ?>
      <li style="background:#fff;">
        <span style="color:#aaa;">?</span>
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
      <li style="background:#fff;">
        <b style="color:#fff;">?</b>
      </li>
    <?php endif; ?>
  </ul>
  <section id="speed">
    <input id="flash_speed" type="range" value="" min="500" max="5000">
  </section>
</section>