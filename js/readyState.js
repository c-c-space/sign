'use strict'

async function submitThis() {
  const symbolAll = document.getElementsByName('symbol');
  const colorAll = document.getElementsByName("color");

  let symbolValue = "";
  for (let i = 0; i < symbolAll.length; i++) {
    if (symbolAll[i].checked) {//(color1[i].checked === true)と同じ
      symbolValue = symbolAll[i].value;
      break;
    }
  }

  let colorlValue = "";
  for (let i = 0; i < colorAll.length; i++) {
    if (colorAll[i].checked) {//(color1[i].checked === true)と同じ
      colorlValue = colorAll[i].value;
      break;
    }
  }

  let thisSign = {
    symbol : symbolValue,
    color : colorlValue
  };

  const signJSON = JSON.stringify(thisSign);
  let url = 'log.php';
  let response = await fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: signJSON
  })

  .then(response => response.json())
  .then(data => {
    console.log(data)
  })
  .catch(error => {
    console.log(error)
  });

  setTimeout(() => {
    location.reload();
  }, 1000);
}

function changeHidden() {
  const mainAll = document.querySelectorAll('main');
  mainAll.forEach(main => {
    if (main.hidden == false) {
      main.hidden = true;
    } else {
      main.hidden = false;
    }
  })
}

const symbolAll = document.getElementsByName('symbol');
let symbolValue = '';

for (let symbol of symbolAll) {
  symbol.addEventListener('change', () => {
    let symbolValue = symbol.value;
    console.log(symbolValue);
  });
}

const colorAll = document.getElementsByName("color");
let colorlValue = '#fff';

for (let color of colorAll) {
  color.addEventListener('change', () => {
    let colorlValue = `#${color.value}`;
    console.log(colorlValue);
  });
}

let thisSign = {
  symbol : symbolValue,
  color : colorlValue
};

const signJSON = JSON.stringify(thisSign);

async function submitThis() {
  let url = 'log.php';
  let response = await fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: signJSON
  })

  .then(response => response.json())
  .then(data => {
    console.log(data)
  })
  .catch(error => {
    console.log(error)
  });

  setTimeout(() => {
    location.reload();
  }, 1000);
}

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

    if(!localStorage.getItem('yourInfo')) {
      async function readmeMD() {
        fetch('readne.md')
        .then(response => response.text())
        .then(readme => {
          document.querySelector('#submit').innerHTML = readme.replace(/\n/g, "<br>");
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
