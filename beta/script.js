'use strict'

let all = document.querySelector('#all');
let flash = document.querySelector('#flash');
let log = document.querySelector('#log');

function allView() {
  if (all.style.opacity == 1) {
    all.style.opacity = 0;
    flash.style.opacity = 0;
    log.style.opacity = 1;
    all.style.zIndex = 0;
    flash.style.zIndex = 0;
    log.style.zIndex = 100;
  } else {
    all.style.opacity = 1;
    flash.style.opacity = 0;
    log.style.opacity = 0;
    all.style.zIndex = 1;
    flash.style.zIndex = 0;
    log.style.zIndex = 0;
  }
}

function flashView() {
  if (flash.style.opacity == 1) {
    flash.style.opacity = 0;
    all.style.opacity = 0;
    log.style.opacity = 1;
    flash.style.zIndex = 0;
    all.style.zIndex = 0;
    log.style.zIndex = 100;
  } else {
    flash.style.opacity = 1;
    all.style.opacity = 0;
    log.style.opacity = 0;
    flash.style.zIndex = 1;
    all.style.zIndex = 0;
    log.style.zIndex = 0;
  }
}

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'loading') {
    // 文書の読み込み中に実行する
  }

  else if (event.target.readyState === 'interactive') {
    let getMonth = {
      '令和三年三月': ['2021','03'],
      '令和三年四月': ['2021','04'],
      '令和三年五月': ['2021','05'],
      '令和三年六月': ['2021','06'],
      '令和三年七月': ['2021','07'],
      '令和三年八月': ['2021','08'],
    }

    const selectLog = document.querySelector('#log select');
    const monthAll = Object.entries(getMonth)
    monthAll.forEach((month) => {
      const optionMonth = document.createElement('option')
      optionMonth.setAttribute('value', Object.values(month[1])[0] + Object.values(month[1])[1])
      optionMonth.setAttribute('data-year', Object.values(month[1])[0])
      optionMonth.setAttribute('data-month', Object.values(month[1])[1])
      optionMonth.innerText = month[0]
      selectLog.appendChild(optionMonth)
    });

    selectLog.addEventListener('change', function() {
      const selectMonth = document.querySelectorAll('#log select option');
      const index =  this.selectedIndex;
      const thisMonth = {
        title : selectMonth[index].innerText,
        year : selectMonth[index].dataset['year'],
        month : selectMonth[index].dataset['month']
      }

      const thisJSON = JSON.stringify(thisMonth);

      // Fetch APIでデータ送信
      async function functionPHP() {
        let url = 'function.php';
        let response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json;charset=utf-8'
          },
          body: thisJSON
        })
      }

      functionPHP();
    });
  }

  else if (event.target.readyState === 'complete') {
  }
});

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
}
