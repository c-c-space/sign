'use strict'

const now = new Date()
let m = now.getMonth() + 1;
let d = now.getDate();

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === 'interactive') {
        if (!localStorage.getItem('yourInfo')) {
            submitHTML('#submit', 'about.php')
            const login = document.querySelector('#submit')
            login.addEventListener('submit', function (event) {
                event.preventDefault()
                setLOG()
            }, false)
        } else {
            submitHTML('#submit', '../form.html')
        }

        let selectMonth = document.querySelector('#selectMonth')
        for (let mm = 1; mm <= 12; mm++) {
            if (mm === m) {
                selectMonth.innerHTML += '<option selected value="' + mm + '">' + mm + ' 月</option>';
            } else {
                selectMonth.innerHTML += '<option value="' + mm + '">' + mm + ' 月</option>';
            }
        }

        let selectDate = document.querySelector('#selectDate');
        for (let dd = 1; dd <= 31; dd++) {
            if (dd === d) {
                selectDate.innerHTML += '<option selected value="' + dd + '">' + dd + ' 月</option>';
            } else {
                selectDate.innerHTML += '<option value="' + dd + '">' + dd + ' 日</option>';
            }
        }
    } else if (event.target.readyState === 'complete') {
        const now = document.querySelector('#now')
        now.addEventListener('submit', (e) => {
            e.preventDefault()
            let nowMonth = document.querySelector('#selectMonth').value;
            let nowDate = document.querySelector('#selectDate').value;
            location.replace(`?m=${nowMonth}&d=${nowDate}`)
        }, false)

        const allDate = document.querySelectorAll('#selectDate option')
        document.querySelector('#selectMonth').addEventListener('change', (event) => {
            let mmm = event.target.value;
            for (let ddd = 1; ddd <= 31; ddd++) {
                if (mmm === "2") {
                    if (ddd === 30 || ddd === 31) {
                        allDate[ddd - 1].disabled = true;
                        allDate[ddd - 1].hidden = true;
                    } else {
                        allDate[ddd - 1].disabled = false;
                        allDate[ddd - 1].hidden = false;
                    }
                } else if (mmm === "4" || mmm === "6" || mmm === "9" || mmm === "11") {
                    if (ddd === 31) {
                        allDate[ddd - 1].disabled = true;
                        allDate[ddd - 1].hidden = true;
                    } else {
                        allDate[ddd - 1].disabled = false;
                        allDate[ddd - 1].hidden = false;
                    }
                } else {
                    allDate[ddd - 1].disabled = false;
                    allDate[ddd - 1].hidden = false;
                }
            }
        })
    }
})

async function submitHTML(query, url) {
    fetch(url)
        .then(response => response.text())
        .then(submit => {
            document.querySelector(query).innerHTML = submit;
        });
}

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
            main.hidden = false;
        }
    })
}

async function signCSV(csv) {
    const response = await fetch(csv + '?' + Date.now())
    const text = await response.text()
    if (text.length <= 1) {
        const allUl = document.querySelector('#all ul')
        const flashUl = document.querySelector('#flash ul')
        allUl.innerHTML += `
        <li>
        <p>
        <u style="background:#000;">
        <span style="color:#000;">?</span>
        </u>
        <b style="color:#fff;">Nothing Here</b>
        </p>
        </li>`;
        flashUl.innerHTML += `
        <li style="background:#aaa;">
        <b style="color:#aaa;">?</b>
        </li>`;
        document.querySelector('#gradient').innerText += '#aaa, ';
        document.querySelector('#count b').textContent = '0';
    } else {
        const data = text.trim().split('\n')
            .map(line => line.split(',').map(x => x.trim()))
            .map(comma => {
                let symbol = comma[0]
                let color = comma[1]
                let time = comma[2]
                const allUl = document.querySelector('#all ul')
                const flashUl = document.querySelector('#flash ul')
                allUl.innerHTML += `
                <li>
                <p>
                <u style="background:#${color};">
                <span style="color:#${color};">${symbol}</span>
                </u>
                <b style="color:#${color};">${time}</b>
                </p>
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
}