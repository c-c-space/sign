'use strict'

let all = document.querySelector('#all');
let flash = document.querySelector('#flash');

function allView() {
  if (all.style.opacity == 1) {
    all.style.opacity = 0;
    flash.style.opacity = 0;
    all.style.zIndex = 0;
    flash.style.zIndex = 0;
  } else {
    all.style.opacity = 1;
    flash.style.opacity = 0;
    all.style.zIndex = 1;
    flash.style.zIndex = 0;
  }
}

function flashView() {
  if (flash.style.opacity == 1) {
    flash.style.opacity = 0;
    all.style.opacity = 0;
    flash.style.zIndex = 0;
    all.style.zIndex = 0;
  } else {
    flash.style.opacity = 1;
    all.style.opacity = 0;
    flash.style.zIndex = 1;
    all.style.zIndex = 0;
  }
}

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
