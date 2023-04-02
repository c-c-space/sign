'use strict'

function setLOG() {
  const symbol = document.getElementsByName('symbol').value;
  const color = document.getElementsByName('color').value;

  const yourInfo = {
    port : hqdn,
    ip : ip,
    os : os
  }

  const yourJSON = JSON.stringify(yourInfo);
  async function submitLOG() {
    let url = '/submit.php';
    let response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8'
      },
      body: yourJSON
    })

    .then(response => response.json())
    .then(data => {
      console.log(data)
    })
    .catch(error => {
      console.log(error)
    });
  }

  submitLOG();
  changeHidden()
}
