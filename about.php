<p hidden>
  <?php
  $ip = $_SERVER["REMOTE_ADDR"];
  $hqdn = $_SERVER["REMOTE_PORT"];
  $os = $_SERVER["HTTP_USER_AGENT"];

  echo "IP <b id='ip'>" . $ip . "</b> | ";
  echo "PORT <b id='hqdn'>" . $hqdn . "</b><br/>";
  echo "<small id='os'>" . $os . "</small>";
  ?>
</p>

<section id="about">
  <h1>This is an Online Communication Tool that Uses Colors and Symbols to post Your Feelings.</h1>
  <p>
    これは、<b>色</b> と <b>記号</b> を使って
    <b>自分の気持ちを知る・表す</b>
    オンライン・コミュニケーションツール です。
  </p>
  <br/>
  <h2>
    Create a Collection of Daily Colors and Symbols with Daily Posts.
  </h2>
  <p>
    <b>18</b> の 色 と <b>35</b> の 記号 から
    選択し、投稿された
    今の気持ちに合う 色 と 記号
    を日毎に記録して、<b>毎日</b> の 気持ちを知る・表す
    <b>色</b> と <b>記号</b> を生成します。
  </p>
  <br/>
  <h2>
    Your Posts are also Saved in Local Storage to Create Your Colors and Symbols.
  </h2>
  <p>
    また、あなたが投稿した 色 と 記号 は
    あなたの <b>ローカルストレージ</b> に 保存され、
    <b>あなた</b> の 気持ちを知る・表す
    <b>色</b> と <b>記号</b> を生成します。
  </p>
  <hr/>
  <button type="button" id="back-btn" onclick="setLOG()">Enter Here</button>
</section>
