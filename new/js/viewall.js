function allView() {
  const all = document.querySelector('#all');
  const flash = document.querySelector('#flash');
  if (all.hidden == true) {
    all.hidden = false
    flash.hidden = true
  } else {
    all.hidden = true
    flash.hidden = true
  }
}

function flashView() {
  const flash = document.querySelector('#flash');
  const all = document.querySelector('#all');
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
      }, false)
      main.hidden = false
    }
  })
}