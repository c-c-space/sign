'use strict'

function set10(num) {
  let ret;
  if (num < 10) { ret = "0" + num; }
  else { ret = num; }
  return ret;
}

function nowOn() {
  const nowTime = new Date();
  const nowHour = set10(nowTime.getHours());
  const nowMin = set10(nowTime.getMinutes());
  const nowSec = set10(nowTime.getSeconds());
  const showTime = nowHour + ":" + nowMin + ":" + nowSec;
  document.querySelector("#showTime").textContent = showTime;
}

setInterval('nowOn()', 1000);

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'loading') {
    // 文書の読み込み中に実行する
  } else if (event.target.readyState === 'interactive') {
    const enterBtn = document.createElement('input')
    enterBtn.setAttribute('type','button')
    enterBtn.setAttribute('id','enter-btn')
    enterBtn.setAttribute('class','hidden')
    enterBtn.setAttribute('value','?')
    enterBtn.setAttribute('onClick','changeHidden()')
    document.body.prepend(enterBtn)

    if(!localStorage.getItem('yourInfo')) {
      async function readmeHTML() {
        fetch('readme.html')
        .then(response => response.text())
        .then(readme => {
          document.querySelector('#submit').innerHTML = readme;
        });
      }
      readmeHTML();
    } else {
      async function submitHTML() {
        fetch('submit.html')
        .then(response => response.text())
        .then(submit => {
          document.querySelector('#submit').innerHTML = submit;
        });
      }
      submitHTML();
    }
  } else if (event.target.readyState === 'complete') {

  }
});

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
}
