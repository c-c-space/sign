'use strict'

window.addEventListener('load', function () {
  viewSlide('#flash ul li');

  function shuffleContent(container) {
    let content = container.find("> *");
    let total = content.length;
    content.each(function() {
      content.eq(Math.floor(Math.random() * total)).prependTo(container);
    });
  }

  $(function() {
    shuffleContent($("#flash ul"));
  });
});

function viewSlide(className, i = -1) {
  let liArr = document.querySelectorAll(className);
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
    viewSlide(className, i);
  }, msec);
}
