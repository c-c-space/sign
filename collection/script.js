const date = new Date()
const year = date.getFullYear()
const month = ("0" + (date.getMonth() + 1)).slice(-2)

const startDate = new Date(year, month - 1, 1) // 月の最初の日を取得
const endDate = new Date(year, month, 0) // 月の最後の日を取得
const endDayCount = endDate.getDate() // 月の末日

let dayCount = 1 // 日にちのカウント
let calendarHtml = '' // HTMLを組み立てる変数


for (let d = 0; d < 31; d++) {
    if (d < 9) {
        calendarHtml += '<option value="0' + dayCount + '">0' + dayCount + '</option>'
        dayCount++
    }
    else if (dayCount > endDayCount) {
    }
    else {
        calendarHtml += '<option value="' + dayCount + '">' + dayCount + '</option>'
        dayCount++
    }
}
document.querySelector('#date').innerHTML = calendarHtml