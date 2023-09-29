'use strict'

function changeHidden() {
  const mainAll = document.querySelectorAll('#submit, main')
  mainAll.forEach(main => {
    if (main.hidden == false) {
      main.hidden = true;
    } else {
      main.animate (
        [
          {opacity: 0},
          {opacity: 1}
        ],
        {duration: 1000}
      )
      main.hidden = false
    }
  })
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
      async function submitHTML() {
        fetch('../about.php')
        .then(response => response.text())
        .then(submit => {
          document.querySelector('#submit').innerHTML = submit;
        });
      }
      submitHTML();
    } else {
      async function submitHTML() {
        fetch('../form.html')
        .then(response => response.text())
        .then(submit => {
          document.querySelector('#submit').innerHTML = submit;
        });
      }
      submitHTML();
    }
  } else if (event.target.readyState === 'complete') {
    if(!localStorage.getItem('yourInfo')) {
      const viewAll = document.querySelector('#viewall')
      viewAll.style.display = "flex"
      viewAll.style.justifyContent = "space-between"
      viewAll.style.width = "100%"
      document.querySelector('#members').remove()
    } else {
      const date = new Date()
      const today = date.getDate()
      const year = date.getFullYear()
      const month = date.getMonth()

      const startDate = new Date(year, month - 1, 1) // 月の最初の日を取得
      const endDate = new Date(year, month, 0) // 月の最後の日を取得
      const endDayCount = endDate.getDate() // 月の末日

      let dayCount = 1
      let thismonth = date.getMonth() + 1
      let selectDate = '<option selected disabled>Select Date</option>'
      for (let d = 0; d < today; d++) {
        if (d < 9) {
          selectDate += '<option value="0' + dayCount + '">' + thismonth + '月' + dayCount + '日' + '</option>'
          dayCount++
        } else {
          selectDate += '<option value="' + dayCount + '">' + thismonth + '月' + dayCount + '日' + '</option>'
          dayCount++
        }
      }
      document.querySelector('#select').innerHTML = selectDate
    }
  }
})
