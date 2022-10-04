const date = new Date()
const today = date.getDate()
const year = date.getFullYear()
const month = date.getMonth()

const startDate = new Date(year, month - 1, 1) // 月の最初の日を取得
const endDate = new Date(year, month, 0) // 月の最後の日を取得
const endDayCount = endDate.getDate() // 月の末日

let dayCount = 1 // 日にちのカウント
let calendarHtml = '' // HTMLを組み立てる変数


for (let d = 0; d < today; d++) {
    if (d < 9) {
        calendarHtml += '<option value="0' + dayCount + '">' + year + '年' + month + '月' + dayCount + '日' + '</option>'
        dayCount++
    }
    else if (dayCount > today) {
    }
    else {
        calendarHtml += '<option value="' + dayCount + '">' + year + '年' + month + '月' + dayCount + '日' + '</option>'
        dayCount++
    }
}
document.querySelector('#date').innerHTML = calendarHtml