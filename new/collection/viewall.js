'use strict'

let all = document.querySelector('#all');
let flash = document.querySelector('#flash');

function allView() {
  if (all.hidden == true) {
    all.hidden = false
    flash.hidden = true
  } else {
    all.hidden = true
    flash.hidden = true
  }
}

function flashView() {
  if (flash.hidden == true) {
    flash.hidden = false
    all.hidden = true
  } else {
    flash.hidden = true
    all.hidden = true
  }
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
        ], {
        duration: 1000
      }
      )
      main.hidden = false
    }
  })
}