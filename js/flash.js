'use strict'

window.addEventListener('load', function () {
  viewSlide('#flash ul li');
});

function viewSlide(elem, i = -1) {
  let liArr = document.querySelectorAll(elem);
  if (i >= 0) {
    liArr[i].style.opacity = 0;
  }
  i++;
  if (i >= liArr.length) {
    i = 0;
  }
  liArr[i].style.opacity = 1;
  const speed = document.querySelector('#flash_speed')
  let msec = speed.max - speed.value;
  setTimeout(function () {
    viewSlide(elem, i);
  }, msec);
}
