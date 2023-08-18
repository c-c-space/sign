/* for /sign/collection/01 ~ 12/ */

let dayCount = 1
let calendarHtml = '<option selected disabled>Select Date</option>'

for (let d = 0; d < endDate; d++) {
  if (d < 9) {
    calendarHtml += '<option value="0' + dayCount + '">' + thismonth + ' 月 ' + dayCount + ' 日' + '</option>'
    dayCount++
  } else {
    calendarHtml += '<option value="' + dayCount + '">' + thismonth + ' 月 ' + dayCount + ' 日' + '</option>'
    dayCount++
  }
}

document.querySelector('#select').innerHTML = calendarHtml
