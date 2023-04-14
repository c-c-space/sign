<section id="all">
  <ul>
    <?php if (!empty($rows)):?>
      <?php foreach ($rows as $row):?>
        <li style="background:#<?= h($row[1])?>;">
          <span style="color:#<?= h($row[1])?>;"><?= h($row[0])?></span>
        </li>
      <?php endforeach;?>
    <?php else:?>
      <li style="background:#000;">
        <span style="color:#fff;">?</span>
      </li>
    <?php endif;?>
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
