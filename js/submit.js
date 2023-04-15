'use strict'

// localStorage から sign を取得
let array = JSON.parse(localStorage.getItem("sign")) || [];
const addData = (timestamp, symbolValue, colorlValue) => {
  array.push({
    timestamp,
    symbolValue,
    colorlValue
  })

  localStorage.setItem("sign", JSON.stringify(array))
  return {timestamp, symbolValue, colorlValue}
}

// タイムスタンプを生成
let getWeek = new Array("日","月","火","水","木","金","土");
const newDate = new Date();
const getYear = newDate.getFullYear();
const getMonth = newDate.getMonth() + 1;
const getDate = newDate.getDate();
const getDay = newDate.getDay();
const getHours = newDate.getHours().toString().padStart(2, '0');
const getMinutes = newDate.getMinutes().toString().padStart(2, '0');
const getSeconds = newDate.getSeconds().toString().padStart(2, '0');

const setDate = getYear + "年" + getMonth + "月" + getDate + "日";
const setWeek = "(" + getWeek[getDay] + ") ";
const setTime = getHours + ":" + getMinutes + ":" + getSeconds;

let timestamp = setDate + setWeek + setTime;


// 色と記号を投稿する
const submitForm = document.querySelector('#submit')
submitForm.addEventListener('submit', submitThis)

async function submitThis() {
  event.preventDefault();
  const symbolAll = document.getElementsByName('symbol')
  const colorAll = document.getElementsByName("color")

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
    color : colorlValue,
    timestamp : timestamp
  };

  // localStorage の sign アイテム に配列を追加
  addData(timestamp, symbolValue, colorlValue)

  const signJSON = JSON.stringify(thisSign)
  let url = 'submit.php';
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
