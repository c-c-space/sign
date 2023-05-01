<section id="all">
  <p><?php echo $month;?> 月 <?php echo $day;?> 日 の 色と記号</p>

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
</section>
