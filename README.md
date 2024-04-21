# Sign
色 と 記号 を使って 自分の気持ちを知る・表す

**18** の 色 と **35** の 記号[^1] から 選択した
色と記号 を 日毎の CSVファイル と ローカルストレージ に 保存[^2]

[^1]: 投稿フォーム [form.html](form.html) / 投稿フォームをスタイリング [form.css](css/form.css)
[^2]: 日毎の CSVファイル に 色と記号 を追加  [submit.php](submit.php) / ローカルストレージ に 色と記号 を追加 [submit.js](js/submit.js)

---

## [index.html](index.html)
ローカルストレージ から 投稿された 色と記号 を 取得[^3] し、
グラデーションカラー[^4] ・フラッシュアニメーション[^5] を生成

[^3]: ローカルストレージ から 色と記号 を 取得し、要素を生成 [readyState.js](js/readyState.js) / [viewall.js](js/viewall.js)
[^4]: トップページをスタイリングするCSS [style.css](css/style.css) / 投稿一覧をスタイリング [all.css](css/all.css)
[^5]: フラッシュ/グラデーションアニメーションを生成 [flash.js](js/flash.js) / フラッシュアニメーションをスタイリング [flash.css](css/flash.css)


## [collection](collection/index.php)
日毎の CSVファイル から 今日の色と記号 を 取得 して　ページを生成
フォームコントロール[^6] から 日毎の投稿[^7] を取得

[^6]: 日付を選択するフォームコントロールを生成 [selectDate.js](js/selectDate.js)
[^7]: フォームコントロールから選択した日付のCSVファイルを取得 [head.php](collection/head.php) / [body.php](collection/body.php)

***

### 参考資料・参考作品

[Color Chat](https://colorchat.soft.works/)

カラーチャットは、新しい生活用品の開発に取り組むソフトウェア開発コミュニティ「Soft」が2019年に発表したアプリケーション。
*※ 2021年現在 日本では利用不可。カラーパネルから色、大きさ・丸みを調整し、テキストではなく色を送り合うメッセンジャーアプリ*


[2019 Worksheet: Synchronicity](https://thecreativeindependent.com/essays/synchronicity-worksheet/)

ニューヨークを拠点とするアーティスト、教育者、芸術管理者のナタリア・ナカザワと、クリエイティブインディペンデントが共同で開発した新年の目標を立てるワークシート。
*※ 音・瞑想・関係性・目標の入力を終えた最後に、理想と現実を色で表す項目があります。*


### [are.na channel](https://www.are.na/cc-group/sign-colors-and-symbols)
