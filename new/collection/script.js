const date = new Date()
const today = date.getDate()
const year = date.getFullYear()
const month = date.getMonth() + 1
const day = date.getDate()
let csvFile = '/sign/collection/' + month + '/' + day + '.csv'

const startDate = new Date(year, date.getMonth() - 1, 1) // 月の最初の日を取得
const endDate = new Date(year, date.getMonth(), 0) // 月の最後の日を取得
const endDayCount = endDate.getDate() // 月の末日

document.addEventListener("DOMContentLoaded", () => {
    sign()

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

    const allMonth = document.querySelectorAll(".month")
    allMonth.forEach(thisMonth => {
        thisMonth.textContent = month
    }, false)

    const allDay = document.querySelectorAll(".day")
    allDay.forEach(thisDay => {
        thisDay.textContent = day
    }, false)
});

async function sign() {
    const cover = document.body
    const response = await fetch(csvFile);
    const text = await response.text();
    const data = text.trim().split('\n')
        .map(line => line.split(',').map(x => x.trim()));
    const gradientAll = data.slice(1)
        .map(color => `#${color[1]},`)
        .join('');
    let size = data.length * 50;
    cover.style.backgroundSize = `100% ${size}%`;
    let speed = data.length * 5;
    cover.style.animation = `gradient ${speed}s ease infinite`;
    cover.style.backgroundImage = `linear-gradient(0deg, ${gradientAll} #fff)`;

    const viewAll = data.slice(1)
        .map(sign => `
        <li>
        <b style="background:#${sign[1]};">
        <span style="color:#${sign[1]};">${sign[0]}</span>
        </b>
        <button type="button">${sign[3]}</button>
        </li>
        `)
        .join('');
    document.querySelector("#all ul").innerHTML = viewAll;

    const flashAll = data.slice(1)
        .map(sign => `
        <li style="background:#${sign[1]};" hidden>
        <b style="color:#${sign[1]};">${sign[0]}</b>
        </li>
        `)
        .join('');
    document.querySelector("#flash ul").innerHTML = flashAll;

    const posts = document.querySelector("#posts");
    posts.textContent = data.length;
}

async function submitHTML(query, url) {
    fetch(url)
        .then(response => response.text())
        .then(submit => {
            document.querySelector(query).innerHTML = submit;
        });
}