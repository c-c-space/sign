'use strict'

let all = document.querySelector('#all');
let flash = document.querySelector('#flash');

function allView() {
  if (all.style.opacity == 1) {
    all.style.opacity = 0;
    flash.style.opacity = 0;
    all.style.zIndex = 0;
    flash.style.zIndex = 0;
  } else {
    all.style.opacity = 1;
    flash.style.opacity = 0;
    all.style.zIndex = 1;
    flash.style.zIndex = 0;
  }
}

function flashView() {
  if (flash.style.opacity == 1) {
    flash.style.opacity = 0;
    all.style.opacity = 0;
    flash.style.zIndex = 0;
    all.style.zIndex = 0;
  } else {
    flash.style.opacity = 1;
    all.style.opacity = 0;
    flash.style.zIndex = 1;
    all.style.zIndex = 0;
  }
}
