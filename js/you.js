'use strict'

const yourAll = document.querySelector('#all ul')
const yourFlash = document.querySelector('#flash ul')
const yourInfo = document.querySelector('#yourInfo')
const yourPost = document.querySelector('#yourpost')

function deleteAll() {
  localStorage.removeItem('sign');

  setTimeout(() => {
    location.reload();
  }, 1000);
}

if(!localStorage.getItem('sign')) {
  yourAll.innerHTML += `<li><p><u style="background:#000;"><span style="color:#000;">?</span></u><b style="color:#fff;">Nothing Here</b></p></li>`
  yourFlash.innerHTML += `<li style="background:#aaa;"><b style="color:#aaa;">?</b></li>`
  yourInfo.innerText = "あなたの投稿はまだありません"
  yourPost.innerText = 'Not Signed Yet'
  document.body.style.backgroundImage = `linear-gradient(0deg, #aaa, #fff)`
} else {
  let youJSON = JSON.parse(localStorage.getItem('sign'));
  yourAll.innerHTML += `<li><p><button type="button" onclick="deleteAll()">全消去 | Delete All</button></p></li>`

  for (let i = 0; i < youJSON.length; i++) {
    let time = youJSON[i].timestamp
    let symbol = youJSON[i].symbolValue
    let color = youJSON[i].colorlValue
    var yourGradient = `#${color},`

    yourAll.innerHTML += `<li><p><u style="background:#${color};"><span style="color:#${color};">${symbol}</span></u><b style="color:#${color};">${time}</b></p></li>`
    yourFlash.innerHTML += `<li style="background:#${color};"><b style="color:#${color};">${symbol}</b></li>`
  }

  yourInfo.innerText = "自分の気持ちを知る・表す"
  yourPost.innerText = youJSON.length + ' の色と記号'
  document.body.style.backgroundImage = "linear-gradient(0deg, " + yourGradient + " #fff)"
}
