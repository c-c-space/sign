<form id="now" class="hidden" method="GET">
  <section id="viewall">
    <button type="button" onclick="allView()">
      <span><?php echo $month;?> 月 <?php echo $day;?> 日</span>
    </button>
    <button type="button" onclick="flashView()">
      <span><?php echo $post;?> の色と記号</span>
    </button>
  </section>
  <section id="members">
    <select id="select" name="day"></select>
    <button type="submit">View The Collection</button>
  </section>
</form>
