'use strict'

function changeHidden() {
  const mainAll = document.querySelectorAll('#submit');
  mainAll.forEach(main => {
    if (main.hidden == false) {
      main.hidden = true;
    } else {
      main.hidden = false;
    }
  })
}


const submitForm = document.querySelector('#submit');
submitForm.addEventListener('submit', submitThis);

async function submitThis() {
  const symbolAll = document.getElementsByName('symbol');
  const colorAll = document.getElementsByName("color");

  let symbolValue = "";
  for (let i = 0; i < symbolAll.length; i++) {
    if (symbolAll[i].checked) {//(color1[i].checked === true)と同じ
      symbolValue = symbolAll[i].value;
      break;
    }
  }

  let colorlValue = "";
  for (let i = 0; i < colorAll.length; i++) {
    if (colorAll[i].checked) {//(color1[i].checked === true)と同じ
      colorlValue = colorAll[i].value;
      break;
    }
  }

  let thisSign = {
    symbol : symbolValue,
    color : colorlValue
  };

  const signJSON = JSON.stringify(thisSign);
  let url = 'log.php';
  let response = await fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: signJSON
  })

  .then(response => response.json())
  .then(data => {
    console.log(data)
  })
  .catch(error => {
    console.log(error)
  });

  setTimeout(() => {
    location.reload();
  }, 1000);
}
