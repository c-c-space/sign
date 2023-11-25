'use strict'

function flash(elem, i = -1) {
  let liArr = document.querySelectorAll(elem);
  if (i >= 0) {
    liArr[i].hidden = true;
  }
  i++;
  if (i >= liArr.length) {
    i = 0;
  }
  liArr[i].hidden = false;
  const speed = document.querySelector('#flash_speed')
  let msec = speed.max - speed.value;
  setTimeout(function () {
    flash(elem, i);
  }, msec);
}
