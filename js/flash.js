'use strict'

window.addEventListener("load", () => {
  viewSlide('#flash ul li');
  const cover = document.body
  let signCount = document.querySelectorAll('#flash ul li').length;
  if (signCount == 1) {
    cover.style.backgroundSize = `100% ${signCount * 100}%`;
  } else {
    cover.style.backgroundSize = `100% ${signCount * 50}%`;
  }
  cover.style.animation = `gradient ${signCount * 5}s ease infinite`;
}, false);

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
