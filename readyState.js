'use strict'

function changeHidden() {
  const mainAll = document.querySelectorAll('#submit, main');
  mainAll.forEach(main => {
    if (main.hidden == false) {
      main.hidden = true;
    } else {
      main.animate (
        [
          {opacity: 0},
          {opacity: 1}
        ], {
          duration: 1000
        }
      )
      main.hidden = false;
    }
  })
}

function deleteAll() {
  localStorage.removeItem('sign');
  setTimeout(() => {
    location.reload();
  }, 1000);
}

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'loading') {
    // 文書の読み込み中に実行する
  } else if (event.target.readyState === 'interactive') {
    if(!localStorage.getItem('yourInfo')) {
      window.location.assign('/sign/collection/');
    } else {
      const enterBtn = document.createElement('input')
      enterBtn.setAttribute('type','button')
      enterBtn.setAttribute('id','enter-btn')
      enterBtn.setAttribute('class','hidden')
      enterBtn.setAttribute('value','?')
      enterBtn.setAttribute('onClick','changeHidden()')
      document.body.prepend(enterBtn)

      async function submitHTML() {
        fetch('form.html')
        .then(response => response.text())
        .then(submit => {
          document.querySelector('#submit').innerHTML = submit;
        });
      }
      submitHTML();
    }
  } else if (event.target.readyState === 'complete') {
    const yourAll = document.querySelector('#all ul')
    const yourFlash = document.querySelector('#flash ul')
    const yourInfo = document.querySelector('#yourInfo')
    const yourPost = document.querySelector('#yourpost')

    if(!localStorage.getItem('sign')) {
      yourAll.innerHTML += `<li><p><u style="background:#000;"><span style="color:#000;">?</span></u><b style="color:#fff;">あなたの投稿はまだありません</b></p></li>`
      yourFlash.innerHTML += `<li style="background:#aaa;"><b style="color:#aaa;">?</b></li>`
      yourInfo.innerText = "投稿はまだありません"
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

      const log = JSON.parse(localStorage.getItem('yourInfo'));
      yourAll.innerHTML += `<li><p><b style="color:#fff;">${log.ip}</b><small>${log.os}</small></p></li>`
      yourInfo.innerText = "自分の気持ちを知る・表す"
      yourPost.innerText = youJSON.length + ' の色と記号'
      document.body.style.backgroundImage = "linear-gradient(0deg," + yourGradient + "#fff)"
    }
  }
});
