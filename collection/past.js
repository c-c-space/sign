'use strict'

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
        ],
        { duration: 1000 }
      )
      main.hidden = false
    }
  })
}

async function submitHTML(query, url) {
  fetch(url)
    .then(response => response.text())
    .then(submit => {
      document.querySelector(query).innerHTML = submit;
    });
}

document.addEventListener('readystatechange', event => {
  if (event.target.readyState === 'interactive') {
    const enterBtn = document.createElement('input')
    enterBtn.setAttribute('type', 'button')
    enterBtn.setAttribute('id', 'enter-btn')
    enterBtn.setAttribute('class', 'hidden')
    enterBtn.setAttribute('value', '?')
    enterBtn.setAttribute('onClick', 'changeHidden()')
    document.body.prepend(enterBtn)

    if (!localStorage.getItem('yourInfo')) {
      submitHTML('#submit', 'about.php');
      const login = document.querySelector('#submit')
      login.addEventListener('submit', function (event) {
        event.preventDefault();
        setLOG()
      }, false)
    } else {
      submitHTML('#submit', '../form.html');
      const submitForm = document.querySelector('#submit')
      submitForm.addEventListener('submit', submitThis)
    }
  } else if (event.target.readyState === 'complete') {
    const members = document.querySelector('#members')

    if (!localStorage.getItem('yourInfo')) {
      const viewAll = document.querySelector('#viewall')
      viewAll.style.display = "flex"
      viewAll.style.justifyContent = "space-between"
      viewAll.style.width = "100%"
      members.remove()
    } else {
      const you = document.createElement('button')
      you.setAttribute('type', 'button')
      you.textContent = '自分の気持ちを知る・表す'
      members.appendChild(you)
      you.addEventListener('click', () => {
        location.assign('/sign/')
      });

      const select = document.createElement('select')
      select.setAttribute('name', 'month')
      members.appendChild(select)

      let selectMonth = '<option selected disabled>View The Collection</option>'

      for (let m = 1; m <= 12; m++) {
        if (m <= 9) {
          selectMonth += '<option value="0' + m + '">' + m + ' 月 の 色と記号</option>'
        } else {
          selectMonth += '<option value="' + m + '">' + m + ' 月 の 色と記号</option>'
        }
      }

      select.innerHTML = selectMonth
      select.addEventListener('change', (event) => {
        location.assign(`${event.target.value}/`)
      });
    }
  }
})
