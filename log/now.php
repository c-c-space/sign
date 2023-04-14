<form id="now" class="hidden" method="GET">
  <section>
    <button type="button" onclick="flashView()">
      <span>
        <b><?php echo $month;?></b> 月
        <b><?php echo $day;?></b> 日
      </span>
    </button>
    <button type="button" onclick="allView()">
      <span>
        <b><?php echo $post;?></b>
        の色と記号
      </span>
    </button>
  </section>
  <section>
    <select id="select" name="day"></select>
    <button type="submit">View The Collection</button>
  </section>
</form>
