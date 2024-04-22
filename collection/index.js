'use strict'

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
    } else if (event.target.readyState === 'complete') {
        viewFlash('#flash ul li')

        const now = document.querySelector('#now')
        now.addEventListener('submit', (e) => {
            e.preventDefault()
            let nowMonth = document.querySelector('#selectMonth').value;
            let nowDate = document.querySelector('#selectDate').value;
            location.replace(`?m=${nowMonth}&d=${nowDate}`)
        }, false)
    }
})

async function submitHTML(query, url) {
    fetch(url)
        .then(response => response.text())
        .then(submit => {
            document.querySelector(query).innerHTML = submit;
        });
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

    const cover = document.body;
    let gradient = document.querySelector('#gradient').innerText;
    cover.style.backgroundImage = "linear-gradient(0deg, " + gradient + "#fff)";
    let signCount = document.querySelectorAll('#all ul li').length;
    if (signCount == 1) {
        cover.style.backgroundSize = `100% ${signCount * 200}%`;
    } else if (signCount <= 5) {
        cover.style.backgroundSize = `100% ${signCount * 100}%`;
    } else {
        cover.style.backgroundSize = `100% ${signCount * 50}%`;
    }
    cover.style.animation = `gradient ${signCount * 5}s ease infinite`;
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