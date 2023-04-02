'use strict'

window.addEventListener('load', function () {
  viewSlide('#flash ul li');
});

function viewSlide(className, i = -1) {
  let liArray = document.querySelectorAll(className);
  if (i >= 0) {
    liArray[i].style.opacity = 0;
  }
  i++;
  if (i >= liArray.length) {
    i = 0;
  }
  liArray[i].style.opacity = 1;
  const speed = document.querySelector('#flash_speed')
  let msec = speed.max - speed.value;
  setTimeout(function () {
    viewSlide(className, i);
  }, msec);
}