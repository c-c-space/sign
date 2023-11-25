'use strict'

const date = new Date()
const today = date.getDate()
const year = date.getFullYear()
const month = date.getMonth() + 1
const day = date.getDate()

const startDate = new Date(year, date.getMonth() - 1, 1) // 月の最初の日を取得
const endDate = new Date(year, date.getMonth(), 0) // 月の最後の日を取得
const endDayCount = endDate.getDate() // 月の末日

document.addEventListener("DOMContentLoaded", () => {
    sign('body', `../../collection/${month}/${day}.csv`)

    const allMonth = document.querySelectorAll(".month")
    allMonth.forEach(thisMonth => {
        thisMonth.textContent = month
    },false)

    const allDay = document.querySelectorAll(".day")
    allDay.forEach(thisDay => {
        thisDay.textContent = day
    },false)
});