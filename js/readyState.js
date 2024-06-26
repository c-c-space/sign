'use strict'

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'interactive') {
    if (!localStorage.getItem('yourInfo')) {
      window.location.replace('collection/')
    } else {
      submitHTML('#submit', 'form.html')

      const log = JSON.parse(localStorage.getItem('yourInfo'))
      document.querySelector('#ip').innerHTML = `by <b>${log.os}</b>`;
      const yourAll = document.querySelector('#all ul')
      const yourFlash = document.querySelector('#flash ul')
      const yourInfo = document.querySelector('#yourInfo')
      const yourPost = document.querySelector('#yourpost')

      if (!localStorage.getItem('sign')) {
        yourAll.innerHTML += `
        <li onclick="changeHidden()">
        <p>
        <u style="background:#000;"><span style="color:#000;">?</span></u>
        <b style="color:#fff;">Submit Your Colors & Symbols</b>
        </p>
        </li>`;

        yourFlash.innerHTML += `
        <li style="background:#aaa;">
        <b style="color:#aaa;">?</b>
        </li>`;

        yourInfo.innerText = "まだ投稿はありません";
        yourPost.innerText = 'Not Signed Yet';
        document.body.style.backgroundImage = `linear-gradient(0deg, #aaa, #fff)`;
      } else {
        let youJSON = JSON.parse(localStorage.getItem('sign'))
        for (let i = 0; i < youJSON.length; i++) {
          let time = youJSON[i].timestamp;
          let symbol = youJSON[i].symbolValue;
          let color = youJSON[i].colorlValue;

          document.querySelector('#gradient').innerText += `#${color}, `;

          const li = document.createElement('li')
          li.innerHTML = `
          <p>
          <u style="background:#${color};"><span style="color:#${color};">${symbol}</span></u>
          <b style="color:#${color};">${time}</b>
          <i>×</i>
          </p>`;
          yourAll.appendChild(li)

          li.addEventListener('click', function () {
            let result = window.confirm('この色と記号をコレクションから削除します。 \r\n Remove This from Your Collection.')
            if (result) {
              youJSON.splice(i, 1)
              localStorage.setItem('sign', JSON.stringify(youJSON))
              location.reload()
            }
          })

          yourFlash.innerHTML += `
          <li style="background:#${color};">
          <b style="color:#${color};">${symbol}</b>
          </li>`;
        }

        yourInfo.innerText = "自分の気持ちを知る・表す";
        yourPost.innerText = youJSON.length + ' の色と記号';

        let gradient = document.querySelector('#gradient').innerText;
        document.body.style.backgroundImage = "linear-gradient(0deg, " + gradient + "#fff)";
      }
    }
  } else if (event.target.readyState === 'complete') {
    viewFlash('#flash ul li')
    BGanimation()
  }
})

function changeHidden() {
  const mainAll = document.querySelectorAll('#submit, main')
  mainAll.forEach(main => {
    if (main.hidden == false) {
      main.hidden = true;
    } else {
      main.animate(
        [
          { opacity: 0 },
          { opacity: 1 }
        ], {
        duration: 1000
      }
      )
      main.hidden = false;
    }
  })
}

async function submitHTML(query, url) {
  fetch(url)
    .then(response => response.text())
    .then(submit => {
      document.querySelector(query).innerHTML = submit;
    })
}