/* for /sign/collection/01 ~ 12/ */

window.addEventListener("load", () => {
  const backBtn = document.createElement('input')
  backBtn.setAttribute('type', 'button')
  backBtn.setAttribute('id', 'enter-btn')
  backBtn.setAttribute('class', 'hidden')
  backBtn.setAttribute('value', '←')
  document.body.prepend(backBtn)

  backBtn.addEventListener('click', () => {
    hitory.back()
  })

  const members = document.querySelector('#members')
  const select = document.createElement('select')
  select.setAttribute('name', 'day')
  members.appendChild(select)

  let selectDate = '<option selected disabled>Select Date</option>'
  
  for (let d = 1; d <= endDate; d++) {
    if (d <= 9) {
      selectDate += '<option value="0' + d + '">' + thismonth + ' 月 ' + d + ' 日' + '</option>'
    } else {
      selectDate += '<option value="' + d + '">' + thismonth + ' 月 ' + d + ' 日' + '</option>'
    }
  }
  
  select.innerHTML = selectDate

  const button = document.createElement('button')
  button.setAttribute('type', 'submit')
  button.textContent = 'View The Collection'
  members.appendChild(button)
}, false);
