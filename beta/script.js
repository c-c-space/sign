function allView() {
  let all = document.querySelector('#all');
  let flash = document.querySelector('#flash');
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
  let flash = document.querySelector('#flash');
  let all = document.querySelector('#all');
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

const selectModal = document.querySelector('#log select');
const optionModal = document.querySelectorAll("#log select option");

selectModal.addEventListener('change', function() {
  const index =  this.selectedIndex;
  window.location.assign(optionModal[index].value);
});
