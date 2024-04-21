'use strict'

window.addEventListener("load", () => {
  viewSlide('#flash ul li')
  BGanimation()
}, false)

window.addEventListener("beforeprint", () => {
  const cover = document.body;
  cover.style.backgroundSize = '100% 100%';
  cover.style.animation = 'gradient none';
}, false)

window.addEventListener("afterprint", () => {
  BGanimation()
}, false)

function BGanimation() {
  const cover = document.body
  let signCount = document.querySelectorAll('#flash ul li').length;
  if (signCount == 1) {
    cover.style.backgroundSize = `100% ${signCount * 200}%`;
  } else if (signCount <= 5) {
    cover.style.backgroundSize = `100% ${signCount * 100}%`;
  } else {
    cover.style.backgroundSize = `100% ${signCount * 50}%`;
  }
  cover.style.animation = `gradient ${signCount * 5}s ease infinite`;
}

let i = 0;
function viewSlide(elem) {
  let liArr = document.querySelectorAll(elem);
  liArr.forEach(liEach => {
    liEach.style.opacity = 0;
  })
  liArr[i].style.opacity = 1;

  const speed = document.querySelector('#flash_speed')
  let msec = speed.max - speed.value;
  if (liArr.length >= 1) {
    speed.remove()
  } else {
    setTimeout(function () {
      if (i === liArr.length - 1) {
        i = 0;
      } else {
        i++;
      }
      viewSlide(elem);
    }, msec);
  }
}
