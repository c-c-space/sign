'use strict'

function allView() {
  let all = document.querySelector('#all');
  let flash = document.querySelector('#flash');
  if (all.style.opacity == 1) {
    all.style.opacity = 0;
    flash.style.opacity = 0;
  } else {
    all.style.opacity = 1;
    flash.style.opacity = 0;
  }
}

function flashView() {
  let flash = document.querySelector('#flash');
  let all = document.querySelector('#all');
  if (flash.style.opacity == 1) {
    flash.style.opacity = 0;
    all.style.opacity = 0;
  } else {
    flash.style.opacity = 1;
    all.style.opacity = 0;
  }
}

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'loading') {
    // 文書の読み込み中に実行する
  }

  else if (event.target.readyState === 'interactive') {
    const enterBtn = document.createElement('input')
    enterBtn.setAttribute('type','button')
    enterBtn.setAttribute('id','enter-btn')
    enterBtn.setAttribute('value','?')
    enterBtn.setAttribute('onClick','changeHidden()')
    document.body.prepend(enterBtn)

    if(!localStorage.getItem('')) {
      document.querySelector('#submit').innerHTML = "";
      async function readmeMD() {
        fetch('about.html')
        .then(response => response.text())
        .then(about => {
          document.querySelector('#submit').innerHTML = about;
        });
      }
      readmeMD();
    } else {
    }
  }

  else if (event.target.readyState === 'complete') {

  }
});

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
}
