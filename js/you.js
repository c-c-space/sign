'use strict'

const yourPost = document.querySelector('#yourpost')

if(!localStorage.getItem('sign')) {
  let youJSON = JSON.parse(localStorage.getItem('sign'));
  yourPost.innerText = youJSON.length + 'の色と記号'

  for (let i = 0; i < youJSON.length; i++) {
    document.body.innerHTML += `ID : ${youJSON[i].timestamp}<br>Name : ${youJSON[i].symbolValue} <br>Age : ${youJSON[i].colorlValue}<br><br><hr><br>`;
  }
} else {
  yourPost.innerText = '?'
}
