'use strict'

async function signCSV(csv) {
  const response = await fetch(csv)
  const text = await response.text()

  if (text.length <= 1) {
    const allUl = document.querySelector('#all ul')
    const flashUl = document.querySelector('#flash ul')
    allUl.innerHTML += `
    <li style="background:#aaa;">
    <span style="color:#aaa;">?</span>
    </li>`;
    flashUl.innerHTML += `
    <li style="background:#aaa;">
    <b style="color:#aaa;">?</b>
    </li>`;
    document.querySelector('#gradient').innerText += `#aaa, `;
    document.querySelector('#count b').textContent = '0';
  } else {
    const data = text.trim().split('\n')
      .map(line => line.split(',').map(x => x.trim()))
      .map(comma => {
        let symbol = comma[0]
        let color = comma[1]
        const allUl = document.querySelector('#all ul')
        const flashUl = document.querySelector('#flash ul')
        allUl.innerHTML += `
        <li style="background:#${color};">
        <span style="color:#${color};">${symbol}</span>
        </li>`;
        flashUl.innerHTML += `
        <li style="background:#${color};">
        <b style="color:#${color};">${symbol}</b>
        </li>`;
        document.querySelector('#gradient').innerText += `#${color}, `;
      });
    document.querySelector('#count b').textContent = data.length;
  }

  let gradient = document.querySelector('#gradient').innerText;
  document.body.style.backgroundImage = "linear-gradient(0deg, " + gradient + "#fff)";
  document.querySelector('#month').textContent = csv.replace(/.csv/g, '')

  viewFlash('#flash ul li')
  BGanimation()
}

let getMonth = {
  '202110': ['令和三年十月'],
  '202111': ['令和三年十一月'],
  '202112': ['令和三年十二月'],
  '202201': ['令和四年一月'],
  '202202': ['令和四年二月'],
  '202203': ['令和四年三月'],
  '202204': ['令和四年四月'],
  '202205': ['令和四年五月'],
  '202206': ['令和四年六月'],
  '202207': ['令和四年七月'],
  '202208': ['令和四年八月'],
  '202209': ['令和四年九月'],
}

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'interactive') {
    const selectMonth = document.querySelector('#selectMonth')
    const monthAll = Object.entries(getMonth)
    monthAll.forEach((month) => {
      const optionMonth = document.createElement('option')
      optionMonth.setAttribute("value", month[0])
      optionMonth.innerText = Object.values(month[1])[0]
      selectMonth.appendChild(optionMonth)
    }, false)

    selectMonth.addEventListener('change', (event) => {
      location.replace(`?date=${event.target.value}`)
    }, false)
  }
})
