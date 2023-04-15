'use strict'

const yourAll = document.querySelector('#all ul')
const yourFlash = document.querySelector('#flash ul')
const yourIP = document.querySelector('#yourIP')
const yourPost = document.querySelector('#yourpost')

function deleteAll() {
  localStorage.removeItem('sign');

  setTimeout(() => {
    location.reload();
  }, 1000);
}

let yourInfo = JSON.parse(localStorage.getItem('yourInfo'));
yourIP.innerText = "IP " + yourInfo.ip

if(!localStorage.getItem('sign')) {
  yourPost.innerText = 'Nothing Here'
  yourAll.innerHTML += `<li><p><u style="background:#000;"><span style="color:#000;">?</span></u><b style="color:#fff;">Nothing Here</b></p></li>`
  yourFlash.innerHTML += `<li style="background:#aaa;"><b style="color:#aaa;">?</b></li>`
  document.body.style.backgroundImage = `linear-gradient(0deg, #aaa, #fff)`
} else {
  let youJSON = JSON.parse(localStorage.getItem('sign'));
  yourPost.innerText = youJSON.length + 'の色と記号'

  yourAll.innerHTML += `<li><p><button type="button" onclick="deleteAll()">全消去 | Delete All</button></p></li>`

  for (let i = 0; i < youJSON.length; i++) {
    let time = youJSON[i].timestamp
    let symbol = youJSON[i].symbolValue
    let color = youJSON[i].colorlValue

    var yourGradient = `#${color},`

    yourAll.innerHTML += `<li><p><u style="background:#${color};"><span style="color:#${color};">${symbol}</span></u><b style="color:#${color};">${time}</b></p></li>`
    yourFlash.innerHTML += `<li style="background:#${color};"><b style="color:#${color};">${symbol}</b></li>`
  }

  document.body.style.backgroundImage = "linear-gradient(0deg, " + yourGradient + " #fff)"
}
