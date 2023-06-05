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
  <button type="button" id="back-btn" onclick="setLOG()">自分の気持ちを知る・表す</button>

  <h1>This is an Online Communication Tool that Using Colors and Symbols that Suit You.</h1>
  <p>これは、<b>色</b> と <b>記号</b> を使って <b>自分の気持ちを知る・表す</b> オンライン・コミュニケーションツール です。</p>
  <hr/>
</section>
<!--
<p><b>色</b> と <b>記号</b> の 投稿 を 日毎 に 記録し、<b>毎日</b> の気持ちを集めた作品を制作します。</p>
<p> <b>_</b></p>
<hr/>
<details>
<summary>令和三年三月から令和三年九月</summary>
<p>18 の <b>色</b> と 35 の <b>記号</b></p>
<button type="button" id="back-btn" onclick="location.assign('beta/')">Sign β ver</button>
</details>
<details>
<summary>令和三年十月から令和四年九月</summary>
<p>18 の <b>色</b> と 35 の <b>記号</b></p>
<button type="button" id="back-btn" onclick="location.assign('members/')">Members Only</button>
</details>
<button type="button" id="back-btn" onclick="setLOG()">Enter</button>

-->
