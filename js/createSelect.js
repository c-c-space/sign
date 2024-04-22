'use strict'

const now = new Date()
let m = now.getMonth() + 1;
let d = now.getDate();

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === 'interactive') {
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
