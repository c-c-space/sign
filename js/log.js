const date = new Date()
const today = date.getDate()
const year = date.getFullYear()
const month = date.getMonth()

const startDate = new Date(year, month - 1, 1) // 月の最初の日を取得
const endDate = new Date(year, month, 0) // 月の最後の日を取得
const endDayCount = endDate.getDate() // 月の末日

let dayCount = 1
let thismonth = date.getMonth() + 1
let calendarHtml = '<option selected disabled>Select Date</option>'

for (let d = 0; d < today; d++) {
  if (d < 9) {
    calendarHtml += '<option value="0' + dayCount + '">' + year + '年' + thismonth + '月' + dayCount + '日' + '</option>'
    dayCount++
  }
  else if (dayCount > today) {
  }
  else {
    calendarHtml += '<option value="' + dayCount + '">' + year + '年' + thismonth + '月' + dayCount + '日' + '</option>'
    dayCount++
  }
}

document.querySelector('#select').innerHTML = calendarHtml
