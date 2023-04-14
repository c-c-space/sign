'use strict'

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
        fetch('php/readme.php')
        .then(response => response.text())
        .then(readme => {
          document.querySelector('#submit').innerHTML = readme;
        });
      }
      readmeHTML();
    } else {
      async function submitHTML() {
        fetch('php/submit.php')
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
